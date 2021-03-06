<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Rider;
use App\Contracts\RiderContract;
use App\Models\RiderAddress;
use App\Models\RiderOrder;
use App\Models\RiderProfile;
use App\Models\RiderSetting;
use http\Env\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
use Yajra\DataTables\Facades\DataTables;


class RiderRepository extends BaseRepository implements RiderContract
{
    /**
     * RiderRepository constructor.
     * @param Rider $model
     */
    public function __construct(Rider $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param int $riderId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRider(int $riderId, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return RiderOrder::with('order', 'order.RestaurantDetails', 'order.orderDetails', 'order.orderDetails.foods', 'order.orderDetails.foodVariants')->where('rider_id', $riderId)->get();
    }

    public function listRiderTodayOrder(int $riderId, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return RiderOrder::with('order', 'order.customer', 'order.RestaurantDetails', 'order.orderDetails', 'order.orderDetails.foods', 'order.orderDetails.foodVariants')->whereDate('ride_date', '>=', date('Y-m-d'))->where('rider_id', $riderId)->get();
    }


    public function allRider()
    {
        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1 edit ridEdit" href="' . route('riders.edit', [$row->id]) . '" title="Rider Edit"><i class="fa fa-pencil"></i> ' . trans("common.edit") . '</a>';

                $actions .= '
                    <form action="' . route('riders.destroy', [$row->id]) . '" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-danger btn-xs ridDelete delete"><i class="fa fa-remove"></i> </button>
                    </form>
                ';

                return $actions;
            })
            ->make(true);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function findRiderById(int $id)
    {
        try {
            return $this->model->with('riderProfile','riderSetting','riderAddress')->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    public function findRiderByIdByAdmin(int $id)
    {
        try {
            return $this->model->with('riderProfile', 'riderSetting', 'riderAddress')->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Rider|mixed
     */
    public function createRider(array $params)
    {
        try {
            DB::beginTransaction();

            $collection = collect($params);

            $phoneNumber = (substr($collection['phone_number'], 0, 3) == '+88') ? $collection['phone_number'] : '+88' . $collection['phone_number'];

            //SEND OTP
            if (sendOtpByTWILIO($phoneNumber)) {

                $created_at = date('Y-m-d');
                $name = 'Rider' . (Rider::where('id', '!=', '')->get()->max('id') + 1);
                $email = 'rider' . (Rider::where('id', '!=', '')->get()->max('id') + 1) . '@dd.com';

                $merge = $collection->merge(compact('created_at', 'name', 'email'));

                if (Rider::where('phone_number', '=', $collection['phone_number'])->count() > 0) {

                    return $rider = Rider::where('phone_number', $collection['phone_number'])->first();
                }

                $rider = new Rider($merge->all());

                $rider->save();

                $riderSettings = new RiderSetting();

                $riderSettings->rider_id = $rider->id;
                $riderSettings->notification = 1;
                $riderSettings->popup_notification = 1;
                $riderSettings->sms = 1;
                $riderSettings->offer_and_promotion = 1;

                $riderSettings->save();


                $riderProfile = new RiderProfile();

                $riderProfile->rider_id = $rider->id;

                $riderProfile->save();

                DB::commit();

                return $rider;
            } else {
                return false;
            }

        } catch (QueryException $exception) {
            DB::rollback();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function riderOTPVerify(array $params)
    {
        try {
            $collection = collect($params);
            $phoneNumber = (substr($collection['phone_number'],0,3)=='+88') ? $collection['phone_number'] : '+88'.$collection['phone_number'];

            if (verifyOtpByTWILIO($phoneNumber, $collection['verification_code'])) {

                tap(Rider::where('phone_number', $phoneNumber))->update(['isVerified' => true]);

                return Rider::where('phone_number', $phoneNumber)->first();

            }else{
                return false;
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return Rider|false
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function createRiderByAdmin(array $params)
    {
        try {
            DB::beginTransaction();

            $collection = collect($params);

            $phone_number = (substr($collection['phone_number'], 0, 3) == '+88') ? $collection['phone_number'] : '+88' . $collection['phone_number'];

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at', 'phone_number'));

            $rider = new Rider($merge->all());

            $rider->save();

//            $riderSettings = new RiderSetting();
//
//            $riderSettings->rider_id = $rider->id;
//            $riderSettings->notification = 1;
//            $riderSettings->popup_notification = 1;
//            $riderSettings->sms = 1;
//            $riderSettings->offer_and_promotion = 1;
//
//            $riderSettings->save();


            $riderProfile = new RiderProfile();

            $riderProfile->rider_id = $rider->id;
            $riderProfile->nid = $collection['nid'];
            $riderProfile->nid = $collection['address'];

            $riderProfile->save();


            $riderAddress = new RiderAddress();

            $riderAddress->rider_id = $rider->id;
            $riderAddress->address = $collection['address'];
            $riderAddress->is_current_address = 'yes';

            $riderAddress->save();

            DB::commit();

            return $rider;


        } catch (QueryException $exception) {
            DB::rollback();
            //throw new InvalidArgumentException($exception->getMessage());
            return false;
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateRiderProfile(array $params, $image)
    {
        $rider = $this->findRiderById($params['rider_id']);

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        if (isset($image)) {
            $image = url('/') . '/public/img/rider/' . $image;
        } else {
            $image = url('/') . '/public/img/rider/default.png';
        }

        $merge = $collection->merge(compact('updated_at', 'image'));

        $rider->update($merge->all());


        //UPDATE RESTAURANT ADDRESS
        RiderAddress::where(["rider_id" => $params['rider_id'], 'is_current_address' => 'yes'])->update(
            [
                "address" => $params['address'],
            ]
        );

        return $rider;
    }

    public function updateDocument(array $params)
    {
        $document = new RiderProfile();

        $collection = collect($params)->except('_token');

        if (isset($params['image'])) {
            $image = url('/') . '/public/img/rider/' . $params['image'];
        } else {
            $image = url('/') . '/public/img/rider/default.png';
        }

        $merge = $collection->merge(compact('image'));

        $affected = $document->where('rider_id', $params['rider_id'])->update($merge->all());

        Rider::where("id", $params['rider_id'])->update(
            [
                "isNew" => 'no',
            ]
        );

        return $affected;
    }

    public function settingsUpdate(array $params)
    {
        $settings = new RiderSetting();

        $collection = collect($params)->except('_token');

        $rider_id = $collection['rider_id'];

        $merge = $collection->merge(compact('rider_id'));

        $affected = $settings->where('rider_id', $params['rider_id'])->update($merge->all());

        return $affected;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteRider($id, array $params)
    {
        $count = Order::where('restaurant_id', $id)->count();

        if($count > 0){
            return false;
        }else {
            $rider = $this->findRiderById($id);
            $rider->delete();

            RiderAddress::where('rider_id', $id)->delete();
            RiderSetting::where('rider_id', $id)->delete();
            RiderProfile::where('rider_id', $id)->delete();

            return $rider;
        }
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }


    public function updateRider(array $params)
    {
        $rider = $this->findRiderById($params['rider_id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $rider->update($merge->all());

        return $rider;
    }

    public function updateRiderByAdmin(array $params)
    {
        $rider = $this->findRiderById($params['rider_id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $rider->update($merge->all());

        RiderProfile::where('rider_id', $params['rider_id'])->update(
            array(
                'nid' => $collection['nid'],
                'address' => $collection['address'],
                'image' => isset($collection['image']) ? isset($collection['image']) :  ($rider->image ? $rider->image : url('/').'/public/img/rider/default.png'),
            )
        );

        RiderAddress::where(["rider_id" => $params['rider_id'], 'is_current_address' => 'yes'])->update(
            [
                "address" => $collection['address'],
            ]
        );


        return $rider;
    }

}
