<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Food;
use App\Models\FoodVariant;
use App\Models\Order;
use App\Models\Restaurant;
use App\Contracts\RestaurantContract;
use App\Models\RestaurantAddress;
use App\Models\RestaurantProfile;
use App\Models\RestaurantReview;
use App\Models\RestaurantSetting;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
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
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function requestedRestaurant(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        //$query = $this->all($columns, $order, $sort);

        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('restaurants.edit', [$row->id]) . '" title="Course Edit"><i class="fa fa-pencil"></i> ' . trans("common.edit") . '</a>';

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
    public function allRestaurants(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('restaurants.edit', [$row->id]) . '" title="Course Edit"><i class="fa fa-pencil"></i> ' . trans("common.edit") . '</a>';

                $actions .= '
                    <form action="' . route('restaurants.destroy', [$row->id]) . '" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> ' . trans("common.delete") . '</button>
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

    public function listRestaurant(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return Restaurant::with('RestaurantDetails', 'coupon', 'foods')->where('status','active')->orderBy('id', 'DESC')->get();
    }

    public function filterRestaurant($params,string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $collection = collect($params);

        $query = Restaurant::with('RestaurantDetails', 'coupon', 'foods');

        if ($collection['price_range'] && !empty($collection['price_range'])) {
            $query->whereHas('foods', function ($q) use ($collection){
                $q->where('restaurant_details.price', '<=', $collection['price_range']);
            });
        }

        $query->orderBy('id', 'DESC')->get();
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
        return Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('restaurant_id', $restaurantId)->get();
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

    public function findRestaurantByIdByAdmin(int $id)
    {
        try {
            //return $this->findOneOrFail($id);
            return $this->model->with('restaurantDetails', 'restaurantSetting', 'restaurantAddress')->findOrFail($id);

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
            DB::beginTransaction();

            $collection = collect($params);

            $phoneNumber = (substr($collection['phone_number'], 0, 3) == '+88') ? $collection['phone_number'] : '+88' . $collection['phone_number'];

            //SEND OTP
            if (sendOtpByTWILIO($phoneNumber)) {

                $maxCat = Category::where('id', '!=', '')->get()->max('id');

                if($maxCat){
                    $maxCat = $maxCat;
                }else{
                    $category = new Category();

                    $category->name = "Category 1";
                    $category->description = "description";
                    $category->image = url('/') . '/public/img/category/default.png';
                    $category->created_at = date('Y-m-d');
                    $category->created_by = 1;

                    $category->save();

                    $maxCat = $category->id;
                }



                $maxId = Restaurant::where('id', '!=', '')->get()->count() + 1;
                $created_at = date('Y-m-d');
                $name = "Restaurant" . $maxId;
                $email = 'restaurant' . $maxId . '@dd.com';

                $merge = $collection->merge(compact('name', 'email', 'created_at'));

                if (Restaurant::where('phone_number', '=', $collection['phone_number'])->count() > 0) {
                    return $restaurant = Restaurant::where('phone_number', $collection['phone_number'])->first();
                }

                $restaurant = new Restaurant($merge->all());

                $restaurant->save();

                //SAVE RESTAURANT PROFILE
                $restaurantProfile = new RestaurantProfile();

                $restaurantProfile->restaurant_id = $restaurant->id;
                $restaurantProfile->name = "Restaurant" . $maxId;
                $restaurantProfile->feature_section = 1;
                $restaurantProfile->delivery_fee = 0;
                $restaurantProfile->delivery_time = "30 min";
                $restaurantProfile->delivery_range = 5;
                $restaurantProfile->ratting = 5;

                $restaurantProfile->save();

                $restaurantSettings = new RestaurantSetting();
                $restaurantSettings->restaurant_id = $restaurant->id;
                $restaurantSettings->save();

                //Default food
                $food = new Food();
                $food->name = "Piza";
                $food->short_description = "Piza";
                $food->image = url('/') . '/public/img/restaurant/default.png';
                $food->discount_price = "10";
                $food->description = "NA";
                $food->ingredients = "NA";
                $food->unit = "NA";
                $food->package_count = "NA";
                $food->weight = "NA";
                $food->featured = 1;
                $food->deliverable_food = 1;
                $food->restaurant_id = $restaurant->id;
                $food->category_id = $maxCat;
                $food->options = "NA";
                $food->created_by = 1;
                $food->created_at = date('Y-m-d');

                $food->save();

                //SAVE FOOD VARIANT
                $foodVariantData = array(
                    array('food_id' => $food->id, 'name' => 'Piza 6 inch', 'price' => 220.00),
                    array('food_id' => $food->id, 'name' => 'Piza 9 inch', 'price' => 420.00),
                    array('food_id' => $food->id, 'name' => 'Piza 12 inch', 'price' => 920.00),
                );

                FoodVariant::insert($foodVariantData);


                //SAVE COUPON
                $coupon = new Coupon();

                $coupon->code = "DD" . $restaurant->id;
                $coupon->total_code = 100;
                $coupon->total_used_code = 0;
                $coupon->discount_type = "fixed";
                $coupon->discount = 20;
                $coupon->description = "NA";
                $coupon->food_id = $food->id;
                $coupon->restaurant_id = $restaurant->id;
                $coupon->category_id = $maxCat;
                $coupon->expire_at = date('Y-m-d', strtotime("+30 days"));
                $coupon->enabled = 1;
                $coupon->status = "active";
                $coupon->created_at = date('Y-m-d');
                $coupon->created_by = 1;

                $coupon->save();

                DB::commit();

                return $restaurant = Restaurant::where('phone_number', $collection['phone_number'])->first();
            } else {
                return false;
            }

        } catch (QueryException $exception) {
            DB::rollback();
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
            $phoneNumber = (substr($collection['phone_number'],0,3)=='+88') ? $collection['phone_number'] : '+88'.$collection['phone_number'];

            if (verifyOtpByTWILIO($phoneNumber, $collection['verification_code'])) {

                tap(Restaurant::where('phone_number', $phoneNumber))->update(['isVerified' => true]);

                return Restaurant::where('phone_number', $phoneNumber)->first();

            }else{
                return false;
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function createRestaurantByAdmin(array $params)
    {
        try {
            DB::beginTransaction();

            $collection = collect($params);

            $phone_number = (substr($collection['phone_number'], 0, 3) == '+88') ? $collection['phone_number'] : '+88' . $collection['phone_number'];
            $created_at = date('Y-m-d');
            $created_by = auth()->user()->id;


//            $maxCat = Category::where('id', '!=', '')->get()->max('id');
//
//            if($maxCat){
//                $maxCat = $maxCat;
//            }else{
//                $category = new Category();
//
//                $category->name = "Category 1";
//                $category->description = "description";
//                $category->image = url('/') . '/public/img/category/default.png';
//                $category->created_at = date('Y-m-d');
//                $category->created_by = 1;
//
//                $category->save();
//
//                $maxCat = $category->id;
//            }

            if (isset($params['image'])) {
                $image = url('/') . '/public/img/restaurant/' . $params['image'];
            } else {
                $image = url('/') . '/public/img/restaurant/default.png';
            }

            $merge = $collection->merge(compact('created_at', 'created_by', 'phone_number', 'image'));

            //SAVE RESTAURANT
            $restaurant = new Restaurant($merge->all());
            $restaurant->save();

            //SAVE RESTAURANT PROFILE
            $restaurantProfile = new RestaurantProfile($merge->all());
            $restaurantProfile->restaurant_id = $restaurant->id;
            $restaurantProfile->feature_section = 1;
            $restaurantProfile->ratting = 5;
            $restaurantProfile->save();

            //SAVE RESTAURANT SETTINGS
            $restaurantSettings = new RestaurantSetting($merge->all());
            $restaurantSettings->restaurant_id = $restaurant->id;
            $restaurantSettings->save();

            //SAVE RESTAURANT ADDRESS
            $restaurantAddress = new RestaurantAddress($merge->all());
            $restaurantAddress->restaurant_id = $restaurant->id;
            $restaurantAddress->save();

//            //Default food
//            $food = new Food();
//            $food->name = "Piza";
//            $food->short_description = "Piza";
//            $food->image = url('/') . '/public/img/restaurant/default.png';
//            $food->discount_price = "10";
//            $food->description = "NA";
//            $food->ingredients = "NA";
//            $food->unit = "NA";
//            $food->package_count = "NA";
//            $food->weight = "NA";
//            $food->featured = 1;
//            $food->deliverable_food = 1;
//            $food->restaurant_id = $restaurant->id;
//            $food->category_id = $maxCat ? $maxCat : 1;
//            $food->options = "NA";
//            $food->created_by = 1;
//            $food->created_at = date('Y-m-d');
//
//            $food->save();
//
//            $foodVariantData = array(
//                array('food_id' => $food->id, 'name' => 'Piza 6 inch', 'price' => 220.00),
//                array('food_id' => $food->id, 'name' => 'Piza 9 inch', 'price' => 420.00),
//                array('food_id' => $food->id, 'name' => 'Piza 12 inch', 'price' => 920.00),
//            );
//
//            FoodVariant::insert($foodVariantData);
//
//            //SAVE COUPON
//            $coupon = new Coupon();
//            $coupon->code = "DD" . $restaurant->id;
//            $coupon->total_code = 100;
//            $coupon->total_used_code = 0;
//            $coupon->discount_type = "fixed";
//            $coupon->discount = 20;
//            $coupon->description = "NA";
//            $coupon->food_id = $food->id;
//            $coupon->restaurant_id = $restaurant->id;
//            $coupon->category_id = $maxCat;
//            $coupon->expire_at = date('Y-m-d', strtotime("+30 days"));
//            $coupon->enabled = 1;
//            $coupon->status = "active";
//            $coupon->created_at = date('Y-m-d');
//            $coupon->created_by = 1;
//
//            $coupon->save();

            DB::commit();

            return $restaurant;

        } catch (QueryException $exception) {
            DB::rollback();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateRestaurantByAdmin(array $params)
    {
        try {
            DB::beginTransaction();

            $restaurant = $this->findRestaurantById($params['id']);

            $collection = collect($params)->except('_token');

            $phone_number = (substr($collection['phone_number'], 0, 3) == '+88') ? $collection['phone_number'] : '+88' . $collection['phone_number'];

            $updated_at = date('Y-m-d');
            $updated_by = auth()->user()->id;

            if (isset($params['image'])) {
                $image = url('/') . '/public/img/restaurant/' . $params['image'];
            } else {
                $image = url('/') . '/public/img/restaurant/default.png';
            }

            $merge = $collection->merge(compact('updated_at', 'updated_by', 'phone_number', 'image'));

            $restaurant->update($merge->all());

            //SAVE RESTAURANT PROFILE
            RestaurantProfile::where('restaurant_id', $restaurant->id)->delete();
            $restaurantProfile = new RestaurantProfile($merge->all());
            $restaurantProfile->restaurant_id = $restaurant->id;
            $restaurantProfile->feature_section = 1;
            $restaurantProfile->ratting = 5;
            $restaurantProfile->save();

            //SAVE RESTAURANT SETTINGS
            RestaurantSetting::where('restaurant_id', $restaurant->id)->delete();
            $restaurantSettings = new RestaurantSetting($merge->all());
            $restaurantSettings->restaurant_id = $restaurant->id;
            $restaurantSettings->save();

            //SAVE RESTAURANT ADDRESS
            RestaurantAddress::where('restaurant_id', $restaurant->id)->delete();
            $restaurantAddress = new RestaurantAddress($merge->all());
            $restaurantAddress->restaurant_id = $restaurant->id;
            $restaurantAddress->save();

            DB::commit();

            return $restaurant;

        } catch (QueryException $exception) {
            DB::rollBack();

            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @param $image
     * @return mixed
     */
    public function updateRestaurantProfile(array $params, $image)
    {
        $restaurant = $this->findRestaurantById($params['restaurant_id']);

        $collection = collect($params)->except('_token');

        $updated_at = date('Y-m-d');

        $merge = $collection->merge(compact('updated_at', 'image'));

        $restaurant->update($merge->all());


        //UPDATE RESTAURANT ADDRESS
        RestaurantAddress::where(["restaurant_id" => $params['restaurant_id'], 'is_current_address' => 'yes'])->update(
            [
                "address" => $params['address'],
            ]
        );

        return $restaurant;
    }

    public function updateDocument(array $params, $image)
    {
        $document = new RestaurantProfile();

        $collection = collect($params)->except('_token');

        $merge = $collection->merge(compact('image'));

        $affected = $document->where('restaurant_id', $params['restaurant_id'])->update($merge->all());

        Restaurant::where("id", $params['restaurant_id'])->update(
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

    public function restaurantReview(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = RestaurantReview::with('customer','restaurant')->latest()->get();

        return Datatables::of($query)

            ->editColumn('customer_phone', function ($row) {
                return $row->customer->phone_number;
            })
            ->editColumn('restaurant', function ($row) {
                return $row->restaurant->name;
            })
            ->editColumn('restaurant_phone', function ($row) {
                return $row->restaurant->phone_number;
            })
            ->make(true);
    }

}
