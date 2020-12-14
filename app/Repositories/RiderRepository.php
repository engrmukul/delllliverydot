<?php

namespace App\Repositories;

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
        return RiderOrder::with('order','order.RestaurantDetails','order.orderDetails', 'order.orderDetails.foods', 'order.orderDetails.foodVariants')->where('rider_id', $riderId)->get();
    }

    public function listRiderTodayOrder(int $riderId, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return RiderOrder::with('order','order.customer','order.RestaurantDetails','order.orderDetails', 'order.orderDetails.foods', 'order.orderDetails.foodVariants')->whereDate('ride_date','>=', date('Y-m-d'))->where('rider_id', $riderId)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findRiderById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

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
            $collection = collect($params);

            $rider = new Rider($collection->all());

            /* Get credentials from .env */
            /*$token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($collection['phone_number'], "sms");*/

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at'));

            if( Rider::where('phone_number','=', $collection['phone_number'])->count() > 0){
                return $rider = Rider::where('phone_number', $collection['phone_number'])->first();
            }

            $rider->save($merge->all());

            $riderProfile = new RiderProfile();

            $riderProfile->rider_id = $rider->id;

            $riderProfile->save();

            return $rider;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function riderOTPVerify(array $params)
    {
        try {
            $collection = collect($params);

            Rider::where('phone_number', $collection['phone_number'])->update(['isVerified' => true]);

            return true;


            /* Get credentials from .env */
            /*$token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);

            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($collection['verification_code'], array('to' => $collection['phone_number']));

            if ($verification->valid) {

                $otp = tap(Rider::where('phone_number', $collection['phone_number']))->update(['isVerified' => true]);

                //return $this->findRiderById($params['id']);
                return $otp;

            }else{
                return false;
            }*/

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateRiderProfile(array $params)
    {
        $rider = $this->findRiderById($params['rider_id']);

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at','image'));

        $rider->update($merge->all());


        //UPDATE RESTAURANT ADDRESS
        RiderAddress::where(["rider_id" => $params['rider_id'], 'is_current_address' => 'yes'])->update(
            [
                "address" =>$params['address'],
            ]
        );

        return $rider;
    }

    public function updateDocument(array $params, $image)
    {
        $document = new RiderProfile();

        $collection = collect($params)->except('_token');

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

        $notification = 1;

        $merge = $collection->merge(compact('notification'));

        $affected = $settings->where('rider_id', $params['rider_id'])->update($merge->all());

        return $affected;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteRider($id, array $params)
    {
        $rider = $this->findRiderById($id);

        $rider->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $rider->update($merge->all());

        return $rider;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }

    /**
     * @return mixed
     */
    public function getRiderList()
    {
        return $this->shopWiseAllData();
    }






}
