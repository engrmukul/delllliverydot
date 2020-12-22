<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Food;
use App\Models\FoodVariant;
use App\Models\Order;
use App\Models\FoodCategory;
use App\Contracts\FoodCategoryContract;
use App\Models\FoodCategoryAddress;
use App\Models\FoodCategoryProfile;
use App\Models\FoodCategorySetting;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
use Yajra\DataTables\Facades\DataTables;


class FoodCategoryRepository extends BaseRepository implements FoodCategoryContract
{
    /**
     * FoodCategoryRepository constructor.
     * @param FoodCategory $model
     */
    public function __construct(FoodCategory $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function requestedFoodCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        //$query = $this->all($columns, $order, $sort);

        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('restaurants.edit', [$row->id]) . '" title="Course Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('restaurants.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->make(true);
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function allFoodCategorys(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('restaurants.edit', [$row->id]) . '" title="Course Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('restaurants.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->make(true);
    }


    /**
     * @param int $restaurantId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function listFoodCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
       return FoodCategory::with('FoodCategoryDetails', 'coupon', 'foods')->get();
    }

    /**
     * @param int $restaurantId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFoodCategoryTodayOrder(int $restaurantId, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return Order::with('customer', 'FoodCategoryDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('restaurant_id', $restaurantId)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findFoodCategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return FoodCategory|mixed
     */
    public function createFoodCategory(array $params)
    {
        try {
            $collection = collect($params);

            $restaurant = new FoodCategory($collection->all());

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

            if( FoodCategory::where('phone_number','=', $collection['phone_number'])->count() > 0){
                return $restaurant = FoodCategory::where('phone_number', $collection['phone_number'])->first();
            }

            $restaurant->save($merge->all());

            $restaurantProfile = new FoodCategoryProfile();

            $restaurantProfile->restaurant_id = $restaurant->id;
            $restaurantProfile->feature_section = 1;
            $restaurantProfile->delivery_fee = 0;
            $restaurantProfile->delivery_time = "30 min";
            $restaurantProfile->delivery_range = 5;
            $restaurantProfile->ratting = 5;

            $restaurantProfile->save();

            $restaurantSettings = new FoodCategorySetting();
            $restaurantSettings->restaurant_id = $restaurant->id;
            $restaurantSettings->save();


            return $restaurant = FoodCategory::where('phone_number', $collection['phone_number'])->first();

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return bool
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function restaurantOTPVerify(array $params)
    {
        try {
            $collection = collect($params);

            /* Get credentials from .env */
            /*$token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);

            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($collection['verification_code'], array('to' => $collection['phone_number']));*/

            //WILL CHANGE
            FoodCategory::where('phone_number', $collection['phone_number'])->update(['isVerified' => true]);

            return true;

            /*if ($verification->valid) {

                $otp = tap(FoodCategory::where('phone_number', $collection['phone_number']))->update(['isVerified' => true]);

                //return $this->findFoodCategoryById($params['id']);
                return $otp;

            } else {
                return false;
            }*/

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function createFoodCategoryByAdmin(array $params)
    {
        try {
            $collection = collect($params);

            $created_at = date('Y-m-d');
            $created_by = auth()->user()->id;

            $merge = $collection->merge(compact('created_at','created_by'));

            //SAVE RESTAURANT
            $restaurant = new FoodCategory($merge->all());
            $restaurant->save();

            //SAVE RESTAURANT PROFILE
            $restaurantProfile = new FoodCategoryProfile($merge->all());
            $restaurantProfile->restaurant_id = $restaurant->id;
            $restaurantProfile->feature_section = 1;
            $restaurantProfile->ratting = 5;
            $restaurantProfile->save();

            //SAVE RESTAURANT SETTINGS
            $restaurantSettings = new FoodCategorySetting($merge->all());
            $restaurantSettings->restaurant_id = $restaurant->id;
            $restaurantSettings->save();

            //SAVE RESTAURANT ADDRESS
            $restaurantAddress = new FoodCategoryAddress($merge->all());
            $restaurantAddress->restaurant_id = $restaurant->id;
            $restaurantAddress->save();

            return $restaurant;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @param $image
     * @return mixed
     */
    public function updateFoodCategoryProfile(array $params, $image)
    {
        $restaurant = $this->findFoodCategoryById($params['restaurant_id']);

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at','image'));

        $restaurant->update($merge->all());


        //UPDATE RESTAURANT ADDRESS
        FoodCategoryAddress::where(["restaurant_id" => $params['restaurant_id'], 'is_current_address' => 'yes'])->update(
            [
                "address" =>$params['address'],
            ]
        );

        return $restaurant;
    }

    public function updateDocument(array $params, $image)
    {
        $document = new FoodCategoryProfile();

        $collection = collect($params)->except('_token');

        $merge = $collection->merge(compact('image'));

        $affected = $document->where('restaurant_id', $params['restaurant_id'])->update($merge->all());

        FoodCategory::where("id", $params['restaurant_id'])->update(
            [
                "isNew" => 'no',
            ]
        );

        return $affected;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function settingsUpdate(array $params)
    {
        $settings = new FoodCategorySetting();

        $collection = collect($params)->except('_token');

        $notification = 1;

        $merge = $collection->merge(compact('notification'));

        $affected = $settings->where('restaurant_id', $params['restaurant_id'])->update($merge->all());

        return $affected;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFoodCategory($id, array $params)
    {
        $restaurant = $this->findFoodCategoryById($id);

        $restaurant->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $restaurant->update($merge->all());

        return $restaurant;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params)
    {
        try {
            $collection = collect($params);

            $category = new Category($collection->all());

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at'));

            $category->save($merge->all());

            return Category::with('items')->where('restaurant_id', $collection['restaurant_id'])->get();

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function categoryUpdate(array $params)
    {
        $category = new Category();

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at'));

        $category->where('restaurant_id', $params['restaurant_id'])->update($merge->all());

        return Category::with('items')->where('restaurant_id', $collection['restaurant_id'])->get();
    }

    public function deleteCategory($id, array $params)
    {
        Category::destroy($id);

        $collection = collect($params)->except('_token');

        $foodIds = Food::where('category_id', $collection['category_id'])->get();

        Food::where('category_id', $collection['category_id'])->destroy();

        FoodVariant::where('food_id', array_column($foodIds, 'id'))->destroy();


        return Category::with('items')->where('restaurant_id', $collection['restaurant_id'])->get();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createLocation(array $params)
    {
        try {
            $collection = collect($params);

            $address = new FoodCategoryOperatingLocation($collection->all());

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at'));

            $address->save($merge->all());

            return $address->get();

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function locationUpdate(array $params)
    {
        $address = new FoodCategoryOperatingLocation();

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at'));

        $address->where(['restaurant_id' => $collection['restaurant_id'], 'id' => $collection['id']])->update($merge->all());

        return FoodCategoryOperatingLocation::where('restaurant_id', $collection['restaurant_id'])->get();
    }

    public function deleteLocation($id, array $params)
    {
        FoodCategoryOperatingLocation::destroy($id);

        $collection = collect($params)->except('_token');

        return FoodCategoryOperatingLocation::where('restaurant_id', $collection['restaurant_id'])->get();
    }

    public function createComplain(array $params)
    {
        try {
            $collection = collect($params);

            $complain = new Complain($collection->all());

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at'));

            $complain->save($merge->all());

            return $complain;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createCreate(array $params)
    {
        try {
            $collection = collect($params);

            $coupon = new Coupon($collection->all());

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at'));

            $coupon->save($merge->all());

            return $coupon->get();

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function couponUpdate(array $params)
    {
        $coupon = new Coupon();

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at'));

        $coupon->where(['restaurant_id' => $collection['restaurant_id'], 'id' => $collection['id']])->update($merge->all());

        return Coupon::where('restaurant_id', $collection['restaurant_id'])->get();
    }

    public function deleteCoupon($id, array $params)
    {
        Coupon::destroy($id);

        $collection = collect($params)->except('_token');

        return Coupon::where('restaurant_id', $collection['restaurant_id'])->get();
    }

}
