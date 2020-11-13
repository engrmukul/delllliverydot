<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Food;
use App\Models\FoodVariant;
use App\Models\Restaurant;
use App\Contracts\RestaurantContract;
use App\Models\RestaurantProfile;
use App\Models\RestaurantSetting;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Twilio\Rest\Client;
use Yajra\DataTables\Facades\DataTables;


class RestaurantRepository extends BaseRepository implements RestaurantContract
{
    /**
     * RestaurantRepository constructor.
     * @param Restaurant $model
     */
    public function __construct(Restaurant $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param int $restaurantId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRestaurant(int $restaurantId, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return Order::with('RestaurantDetails','orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->where('restaurant_id', $restaurantId)->get();
    }

    /**
     * @param int $restaurantId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRestaurantTodayOrder(int $restaurantId, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return Order::with('customer','RestaurantDetails','orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date','>=', date('Y-m-d'))->where('restaurant_id', $restaurantId)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findRestaurantById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Restaurant|mixed
     */
    public function createRestaurant(array $params)
    {
        try {
            $collection = collect($params);

            $restaurant = new Restaurant($collection->all());

            /* Get credentials from .env */
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($collection['phone_number'], "sms");

            $created_at = date('Y-m-d');

            $merge = $collection->merge(compact('created_at'));

            $restaurant->save($merge->all());

            $restaurantProfile = new RestaurantProfile();

            $restaurantProfile->restaurant_id = $restaurant->id;

            $restaurantProfile->save();

            $restaurantSettings = new RestaurantSetting();
            $restaurantSettings->restaurant_id = $restaurant->id;
            $restaurantSettings->save();


            return $restaurant;

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
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);

            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($collection['verification_code'], array('to' => $collection['phone_number']));

            if ($verification->valid) {

                $otp = tap(Restaurant::where('phone_number', $collection['phone_number']))->update(['isVerified' => true]);

                //return $this->findRestaurantById($params['id']);
                return $otp;

            }else{
                return false;
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateRestaurantProfile(array $params)
    {
        $restaurant = $this->findRestaurantById($params['restaurant_id']);

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at'));

        $restaurant->update($merge->all());

        //$profile = new RestaurantProfile();

        //$profileCollection = collect($params['address'])->except('_token');

        //$dob = '';

        //$profileMerge = $profileCollection->merge(compact('dob'));

        //$profile->where('restaurant_id', $params['restaurant_id'])->update($profileMerge->all());


        return $restaurant;
    }

    public function updateDocument(array $params, $image)
    {
        $document = new RestaurantProfile();

        $collection = collect($params)->except('_token');

        $merge = $collection->merge(compact('image'));

        $affected = $document->where('restaurant_id', $params['restaurant_id'])->update($merge->all());

        return $affected;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function settingsUpdate(array $params)
    {
        $settings = new RestaurantSetting();

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
    public function deleteRestaurant($id, array $params)
    {
        $restaurant = $this->findRestaurantById($id);

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

        FoodVariant::where('food_id', array_column($foodIds,'id'))->destroy();


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

            $address = new RestaurantOperatingLocation($collection->all());

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
        $address = new RestaurantOperatingLocation();

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at'));

        $address->where(['restaurant_id' => $collection['restaurant_id'], 'id' => $collection['id']])->update($merge->all());

        return RestaurantOperatingLocation::where('restaurant_id', $collection['restaurant_id'])->get();
    }

    public function deleteLocation($id, array $params)
    {
        RestaurantOperatingLocation::destroy($id);

        $collection = collect($params)->except('_token');

        return RestaurantOperatingLocation::where('restaurant_id', $collection['restaurant_id'])->get();
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
