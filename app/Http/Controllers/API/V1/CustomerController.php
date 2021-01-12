<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\CustomerContract;
use App\Http\Requests\CustomerAddressStoreFormRequest;
use App\Http\Requests\CustomerAddressUpdateFormRequest;
use App\Http\Requests\CustomerOrderRequest;
use App\Http\Requests\CustomerOTPVerificationFormRequest;
use App\Http\Requests\CustomerPhoneVerificationFormRequest;
use App\Http\Requests\CustomerSettingsFormRequest;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;
use App\Http\Requests\DeliveryStoreFormRequest;
use App\Http\Requests\PromoCodeRequest;
use App\Http\Requests\PromotionalRestaurantsRequest;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Extra;
use App\Models\FavoriteRestaurant;
use App\Models\FoodVariant;
use App\Models\HelpAndSupport;
use App\Models\Point;
use App\Models\PromotionalBanner;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\ShopItem;
use App\Models\ShopPromotion;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Contracts\RestaurantContract;
use App\Models\CustomerAddress;
use App\Models\CustomerProfile;
use App\Models\Delivery;
use App\Models\FavoriteFood;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use stdClass;

class CustomerController extends BaseController
{
    protected $customerRepository;
    protected $restaurantRepository;

    public function __construct(CustomerContract $customerRepository, RestaurantContract $restaurantRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->restaurantRepository = $restaurantRepository;
    }

    public function store(CustomerPhoneVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $customer = $this->customerRepository->createCustomer($params);

        if ($customer) {
            return $this->sendResponse($customer, 'Customer create successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    protected function otpVerify(CustomerOTPVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $customerVerify = $this->customerRepository->customerOTPVerify($params);

        if ($customerVerify) {

            $phoneNumber = (substr($request->phone_number,0,3)=='+88') ? $request->phone_number : '+88'.$request->phone_number;

            $customer = Customer::where('phone_number', $phoneNumber)->first();

            $customerProfile = CustomerProfile::where('customer_id', $customer->id)->first();

            $customer->image = $customerProfile ? $customerProfile->image : "";
            $customer->address = $customerProfile ? $customerProfile->address : "";

            return $this->sendResponse($customer, 'Phone number verify success', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Customer code not valid', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantList()
    {
        $banners = Banner::all();

        $restaurantsFavorite = $this->restaurantRepository->listRestaurant();
        $restaurantsDiscounted = $this->restaurantRepository->listRestaurant();
        $restaurantsTrending = $this->restaurantRepository->listRestaurant();
        $restaurantsPopular = $this->restaurantRepository->listRestaurant();

        if ($restaurantsFavorite->count() > 0 || $restaurantsDiscounted->count() > 0 || $restaurantsTrending->count() > 0 || $restaurantsPopular->count() > 0) {
            $data =
                array(
                    'banners' => $banners,
                    'restaurant' => array(
                        array(
                            'title' => 'favorite',
                            'restaurants' => $restaurantsFavorite
                        ),
                        array(
                            'title' => 'discounted',
                            'restaurants' => $restaurantsDiscounted
                        ),
                        array(
                            'title' => 'trending',
                            'restaurants' => $restaurantsTrending
                        ),
                        array(
                            'title' => 'popular',
                            'restaurants' => $restaurantsPopular
                        ),
                    )
                );


            return $this->sendResponse($data, 'Group of Restaurant list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }

    }

    public function promotionalRestaurants(PromotionalRestaurantsRequest $request)
    {
        $restaurantList = Restaurant::with(['RestaurantDetails', 'coupon', 'foods',
            'favoriteRestaurant' => function ($q) use ($request) {
                $q->where('customer_id', '=', $request->customer_id);
            }])->orderBy('id', 'DESC')->get();

        $promotionalBanner = PromotionalBanner::where('id', 1)->first();

        if ($restaurantList->count() > 0) {

            $data =
                array(
                    "promotional_banner" => $promotionalBanner,
                    "promotional_restaurant" => array(
                        'title' => 'Promotional restaurant',
                        'restaurants' => $restaurantList
                    )
                );

            return $this->sendResponse($data, 'Promotional restaurant list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function filter(Request $request)
    {
        $restaurantList = Restaurant::with(['RestaurantDetails', 'coupon', 'foods',
            'favoriteRestaurant' => function ($q) use ($request) {
                $q->where('customer_id', '=', $request->customer_id);
            }])->orderBy('id', 'DESC')->get();

        if ($restaurantList->count() > 0) {

            return $this->sendResponse($restaurantList, 'Promotional restaurant list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }

    }

    public function restaurantPanel(Request $request)
    {
        $items = Food::with(['categories', 'foodVariants',
            'favoriteFood' => function ($q) use ($request) {
                $q->where('customer_id', '=', $request->customer_id);
            }])->where('restaurant_id', $request->restaurant_id)->get();

        $promotionalFoods = Food::with('coupon')->get();

        if ($items->count() > 0) {
            $allData = array();
            foreach ($items as $item) {
                //dd($item->toArray());
                $data = array(
                    'title' => $item->categories->name,
                    'items' => $items,
                );

                $allData[] = $data;
            }

            $itemData = array(
                "promotional_foods" => $promotionalFoods,
                "food_items" => $allData,
            );

            return $this->sendResponse($itemData, 'Food items', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function foodVariants(Request $request)
    {
        $items = FoodVariant::where('food_id', $request->food_id)->get();
        $extra = Extra::where('food_id', $request->food_id)->get();

        if ($items->count() > 0) {

            $data = array(
                'food_variants' => $items,
                'extra_item' => $extra
            );

            return $this->sendResponse($data, 'Food variants', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }


    public function itemList(Request $request)
    {
        $items = Food::where('restaurant_id', $request->restaurant_id)->get();

        return $this->sendResponse($items, 'Items retrieved successfully.', Response::HTTP_OK);
    }

    public function myLocation(Request $request)
    {
        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->orderBy('is_current_address', 'desc')->get();

        if ($customerAddress->count() > 0) {
            return $this->sendResponse($customerAddress, 'Promotional restaurant list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function myLocationSave(CustomerAddressStoreFormRequest $request)
    {
        $myLocation = new CustomerAddress();

        $myLocation->customer_id = $request->customer_id;
        $myLocation->address = $request->address;
        $myLocation->is_current_address = $request->is_current_address;

        if ($myLocation->save()) {
            if ($request->is_current_address == 'yes') {
                CustomerAddress::where("id", '!=', $myLocation->id)->where("customer_id", $request->customer_id)->update(
                    [
                        "is_current_address" => 'no',
                    ]
                );
            }

            $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->orderBy('is_current_address', 'desc')->get();

            if ($customerAddress->count()) {
                /*$data = array(
                    'title' => 'Address list',
                    'addresses' => $customerAddress
                );*/
                return $this->sendResponse($customerAddress, 'Location saved', Response::HTTP_OK);

            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        } else {
            $this->sendResponse(array(), 'server error', Response::HTTP_NOT_FOUND);
        }
    }

    public function myLocationUpdate(CustomerAddressUpdateFormRequest $request)
    {
        CustomerAddress::where("id", $request->id)->update(
            [
                "customer_id" => $request->customer_id,
                "address" => $request->address,
                "is_current_address" => $request->is_current_address,
            ]
        );

        if ($request->is_current_address == 'yes') {
            CustomerAddress::where("id", '!=', $request->id)->where("customer_id", $request->customer_id)->update(
                [
                    "is_current_address" => 'no',
                ]
            );
        }

        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->orderBy('is_current_address', 'desc')->get();

        if ($customerAddress->count() > 0) {
            /*$data = array(
                'title' => 'Address list',
                'addresses' => $customerAddress
            );*/
            return $this->sendResponse($customerAddress, 'Promotional restaurant list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function myLocationDelete(Request $request)
    {
        CustomerAddress::where(['id' => $request->id, 'customer_id' => $request->customer_id])->delete();


        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->orderBy('is_current_address', 'desc')->get();

        if ($customerAddress->count() > 0) {
            return $this->sendResponse($customerAddress, 'CUstomer Address list', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function customerSelectedLocation(Request $request)
    {
        $customerAddress = CustomerAddress::where(['customer_id' => $request->customer_id, 'is_current_address' => 'yes'])->first();

        if ($customerAddress) {
            return $this->sendResponse($customerAddress, 'Customer selected address', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function myProfile(Request $request)
    {
        $customer = Customer::where('id', $request->customer_id)->first();
        $customerProfile = CustomerProfile::where('customer_id', $request->customer_id)->first();

        $customer->image = $customerProfile->image;
        $customer->address = $customerProfile->address;

        if ($customer) {
            return $this->sendResponse($customer, 'Customer selected address', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function customerProfileUpdate(CustomerUpdateFormRequest $request, Customer $customerModel)
    {
        try {
            DB::beginTransaction();

            if ($request->file('image') != null) {

                $imageName = $this->saveImages($request->file('image'), 'img/customer/', 100, 100);

                $image = url('/') . '/public/img/customer/' . $imageName;
            } else {
                $image = url('/') . '/public/img/customer/default.png';
            }

            $phoneNumber = (substr($request->phone_number,0,3)=='+88') ? $request->phone_number : '+88'.$request->phone_number;

            Customer::where("id", $request->customer_id)->update(
                [
                    "phone_number" => $phoneNumber,
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => 123456,
                ]
            );

            if ($request->file('image') != null) {
                CustomerProfile::where("customer_id", $request->customer_id)->update(
                    [
                        "image" => $image,
                        "address" => $request->address
                    ]
                );
            } else {
                CustomerProfile::where("customer_id", $request->customer_id)->update(
                    [
                        "address" => $request->address
                    ]
                );
            }

            CustomerAddress::where("customer_id", $request->customer_id)->update(
                [
                    "address" => $request->address,
                    "is_current_address" => "yes"
                ]
            );


            $customer = Customer::where('id', $request->customer_id)->first();
            $customerProfile = CustomerProfile::where('customer_id', $request->customer_id)->first();

            $customer->image = $customerProfile->image;
            $customer->address = $customerProfile->address;

            DB::commit();

            if ($customer) {
                return $this->sendResponse($customer, 'Customer update successfully.', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $exception) {
            DB::rollback();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function saveOrUpdateFavoriteFood(Request $request)
    {
        $favoriteFood = FavoriteFood::updateOrCreate(
            ['customer_id' => $request->customer_id, 'food_id' => $request->food_id]
        );

        $items = Food::with(['categories', 'foodVariants',
            'favoriteFood' => function ($q) use ($request) {
                $q->where('customer_id', '=', $request->customer_id);
            }])->where('restaurant_id', $request->restaurant_id)->get();

        //$promotionalFoods = Food::with('coupon')->get();

        if ($items->count() > 0) {
            $allData = array();
            foreach ($items as $item) {
                //dd($item->toArray());
                $data = array(
                    'title' => $item->categories->name,
                    'items' => $items,
                );

                $allData[] = $data;
            }

            $itemData = array(
               // "promotional_foods" => $promotionalFoods,
                "food_items" => $allData,
            );

            return $this->sendResponse($itemData, 'Food items', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function removeFavoriteFood(Request $request)
    {
        $deleteFavoriteFood = FavoriteFood::where(['customer_id' => $request->customer_id, 'food_id' => $request->food_id])->delete();

        $items = Food::with(['categories', 'foodVariants',
            'favoriteFood' => function ($q) use ($request) {
                $q->where('customer_id', '=', $request->customer_id);
            }])->where('restaurant_id', $request->restaurant_id)->get();

        //$promotionalFoods = Food::with('coupon')->get();

        if ($items->count() > 0) {
            $allData = array();
            foreach ($items as $item) {
                //dd($item->toArray());
                $data = array(
                    'title' => $item->categories->name,
                    'items' => $items,
                );

                $allData[] = $data;
            }

            $itemData = array(
                //"promotional_foods" => $promotionalFoods,
                "food_items" => $allData,
            );

            return $this->sendResponse($itemData, 'Food items', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function saveOrUpdateFavoriteRestaurant(Request $request)
    {
        $favoriteRestaurant = FavoriteRestaurant::updateOrCreate(
            ['customer_id' => $request->customer_id, 'restaurant_id' => $request->restaurant_id]
        );

        if($request->is_promotional == 'true'){
            $restaurantList = Restaurant::with(['RestaurantDetails', 'coupon', 'foods',
                'favoriteRestaurant' => function ($q) use ($request) {
                    $q->where('customer_id', '=', $request->customer_id);
                }])->orderBy('id', 'DESC')->get();

            if ($restaurantList->count() > 0) {

                $data =
                    array(
                        "promotional_restaurant" => array(
                            'title' => 'Promotional restaurant',
                            'restaurants' => $restaurantList
                        )
                    );

                return $this->sendResponse($data, 'Promotional restaurant list', Response::HTTP_OK);

            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        }else{
            $restaurantsFavorite = $this->restaurantRepository->listRestaurant();
            $restaurantsDiscounted = $this->restaurantRepository->listRestaurant();
            $restaurantsTrending = $this->restaurantRepository->listRestaurant();
            $restaurantsPopular = $this->restaurantRepository->listRestaurant();

            if ($restaurantsFavorite->count() > 0 || $restaurantsDiscounted->count() > 0 || $restaurantsTrending->count() > 0 || $restaurantsPopular->count() > 0) {
                $data =
                    array(
                        'restaurant' => array(
                            array(
                                'title' => 'favorite',
                                'restaurants' => $restaurantsFavorite
                            ),
                            array(
                                'title' => 'discounted',
                                'restaurants' => $restaurantsDiscounted
                            ),
                            array(
                                'title' => 'trending',
                                'restaurants' => $restaurantsTrending
                            ),
                            array(
                                'title' => 'popular',
                                'restaurants' => $restaurantsPopular
                            ),
                        )
                    );


                return $this->sendResponse($data, 'Group of Restaurant list.', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        }


    }

    public function removeFavoriteRestaurant(Request $request)
    {
        $deleteFavoriteRestaurant = FavoriteRestaurant::where(['customer_id' => $request->customer_id, 'restaurant_id' => $request->restaurant_id])->delete();

        if($request->is_promotional == 'true'){
            $restaurantList = Restaurant::with(['RestaurantDetails', 'coupon', 'foods',
                'favoriteRestaurant' => function ($q) use ($request) {
                    $q->where('customer_id', '=', $request->customer_id);
                }])->orderBy('id', 'DESC')->get();

            if ($restaurantList->count() > 0) {

                $data =
                    array(
                        "promotional_restaurant" => array(
                            'title' => 'Promotional restaurant',
                            'restaurants' => $restaurantList
                        )
                    );

                return $this->sendResponse($data, 'Promotional restaurant list', Response::HTTP_OK);

            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        }else{
            $restaurantsFavorite = $this->restaurantRepository->listRestaurant();
            $restaurantsDiscounted = $this->restaurantRepository->listRestaurant();
            $restaurantsTrending = $this->restaurantRepository->listRestaurant();
            $restaurantsPopular = $this->restaurantRepository->listRestaurant();

            if ($restaurantsFavorite->count() > 0 || $restaurantsDiscounted->count() > 0 || $restaurantsTrending->count() > 0 || $restaurantsPopular->count() > 0) {
                $data =
                    array(
                        'restaurant' => array(
                            array(
                                'title' => 'favorite',
                                'restaurants' => $restaurantsFavorite
                            ),
                            array(
                                'title' => 'discounted',
                                'restaurants' => $restaurantsDiscounted
                            ),
                            array(
                                'title' => 'trending',
                                'restaurants' => $restaurantsTrending
                            ),
                            array(
                                'title' => 'popular',
                                'restaurants' => $restaurantsPopular
                            ),
                        )
                    );
                return $this->sendResponse($data, 'Group of Restaurant list.', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function myFavoriteFood(Request $request)
    {
        //$favoriteFoods = FavoriteFood::with('foods', 'foods.categories', 'foods.restaurants', 'foods.restaurants.restaurantDetails', 'foods.foodVariants')->where('customer_id', $request->customer_id)->get();


        //$favoriteRestaurants = FavoriteRestaurant::with('restaurant', 'restaurantProfile')->where('customer_id', $request->customer_id)->get();


        $foodQuery = Food::with('categories', 'foodVariants','favoriteFood');

        if ($request->has('customer_id')) {
            $foodQuery->whereHas('favoriteFood', function ($q) use ($request) {
                $q->where('favorite_foods.customer_id', $request->customer_id);
            });
        }

        $favoriteFoods = $foodQuery->get();



        $restaurantQuery = Restaurant::with('favoriteRestaurant','RestaurantDetails', 'coupon', 'foods');

        if ($request->has('customer_id')) {
            $restaurantQuery->whereHas('favoriteRestaurant', function ($q) use ($request) {
                $q->where('favorite_restaurants.customer_id', $request->customer_id);
            });
        }

        $restaurantList = $restaurantQuery->orderBy('id', 'DESC')->get();


        if ($favoriteFoods->count() > 0 || $restaurantList->count() > 0 ) {

            /*$favoriteFoodsArray = array();

            foreach ($favoriteFoods->toArray() as $favoriteFood) {
                $favoriteFoodData['image'] = $favoriteFood['foods']['image'];
                $favoriteFoodData['category_name'] = $favoriteFood['foods']['categories']['name'];
                $favoriteFoodData['food_name'] = $favoriteFood['foods']['name'];
                $favoriteFoodData['delivery_fee'] = $favoriteFood['foods']['restaurants']['restaurant_details']['delivery_fee'];
                $favoriteFoodData['current_price'] = "From TK " . doubleval($favoriteFood['foods']['food_variants'][0]['price'] - $favoriteFood['foods']['restaurants']['restaurant_details']['discount']);
                $favoriteFoodData['prev_price'] = "TK " . doubleval($favoriteFood['foods']['food_variants'][0]['price']);

                $favoriteFoodsArray[] = $favoriteFoodData;
            }

            if ($favoriteRestaurants->count() > 0) {

                $favoriteRestaurantArray = array();

                foreach ($favoriteRestaurants->toArray() as $favoriteRestaurant) {
                    $favoriteRestaurantData['restaurant_id'] = $favoriteRestaurant['restaurant_id'];
                    $favoriteRestaurantData['name'] = $favoriteRestaurant['restaurant']['name'];
                    $favoriteRestaurantData['phone_number'] = $favoriteRestaurant['restaurant']['phone_number'];
                    $favoriteRestaurantData['image'] = $favoriteRestaurant['restaurant_profile']['image'];
                    $favoriteRestaurantArray[] = $favoriteRestaurantData;
                }
            }*/


            return $this->sendResponse(array('foods' => $favoriteFoods, 'restaurants' => $restaurantList), 'Update my favorite list', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function myDeliverySave(DeliveryStoreFormRequest $request)
    {
        $myDelivery = new Delivery();

        $myDelivery->customer_id = $request->customer_id;
        $myDelivery->from_name = $request->from_name;
        $myDelivery->from_phone = $request->from_phone;
        $myDelivery->from_email = $request->from_email;
        $myDelivery->from_address = $request->from_address;
        $myDelivery->to_name = $request->to_name;
        $myDelivery->to_phone = $request->to_phone;
        $myDelivery->to_email = $request->to_email;
        $myDelivery->to_address = $request->to_address;
        $myDelivery->to_area = $request->to_area;
        $myDelivery->to_district = $request->to_district;
        $myDelivery->to_post_code = $request->to_post_code;
        $myDelivery->item_name = $request->item_name;
        $myDelivery->item_type = $request->item_type;
        $myDelivery->width = $request->width;
        $myDelivery->height = $request->height;
        $myDelivery->length = $request->length;
        $myDelivery->weight = $request->weight;
        $myDelivery->instructions = $request->instructions;
        $myDelivery->pickup_time = $request->pickup_time;
        $myDelivery->status = 'processing';
        $myDelivery->send_date = date('Y-m-d');

        if ($myDelivery->save()) {
            return $this->sendResponse($myDelivery, 'Delivery added successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }

    public function myDeliveryList(Request $request)
    {
        $deliveries = Delivery::where('customer_id', $request->customer_id)->get();

        if ($deliveries->count() > 0) {
            $deliveryDataArray = array();
            foreach ($deliveries as $key => $delivery){
                $deliveryData['send_date'] = $delivery->send_date;
                $deliveryData['item_name'] = $delivery->item_name;
                $deliveryData['to'] = $delivery->to_name .", ". $delivery->to_address;
                $deliveryData['to_phone'] = $delivery->to_phone;
                $deliveryData['est'] = $delivery->pickup_time;
                $deliveryData['status'] = $delivery->status;

                $deliveryDataArray[] = $deliveryData;
            }

            return $this->sendResponse($deliveryDataArray, 'My delivery list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function settings(Request $request)
    {
        $settings = Setting::where('customer_id', $request->customer_id)->first();

        if ($settings) {
            return $this->sendResponse($settings, 'My settings.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function settingsUpdate(CustomerSettingsFormRequest $request)
    {
        $params = $request->except('_token');

        $this->customerRepository->settingsUpdate($params);

        $settings = Setting::where('customer_id', $request->customer_id)->first();

        if ($settings->count() > 0) {
            return $this->sendResponse($settings, 'Customer settings update successfully.',Response::HTTP_OK);
        }else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }

    public function applyPromoCode(PromoCodeRequest $request)
    {
        $promotion = Coupon::where('code', $request->code)->first();

        if ($promotion) {
            return $this->sendResponse(doubleval(round($promotion->discount, '2')), 'Discount', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function order(CustomerOrderRequest $request)
    {
        //WILL USE TRANSACTION

        $orderData = json_decode($request->getContent(), true);

        if ($orderData) {
            $order = new Order();

            $order->customer_id = $orderData['customer_id'];
            $order->delivery_address = $orderData['address'];
            $order->order_date = date('Y-m-d');
            $order->order_status = 'order_placed';
            $order->payment_method = 'cash_on_delivery';//$orderData['payment_method;
            $order->payment_status = 'not_paid';//$orderData['payment_status;
            $order->total_price = $orderData['sub_total'];
            $order->discount = $orderData['discount'];
            $order->vat = $orderData['vat_amount'];
            $order->delivery_fee = $orderData['delivery_fee'];
            $order->instructions = $orderData['instructions'];
            $order->restaurant_id = $orderData['restaurantId'];
            $order->coupon_code = $orderData['coupon_code'];

            $order->save();

            $foodArray = array();
            foreach ($orderData['carts'] as $key => $item) {

                if ($item['extraItemId'] == 0 || $item['extraItemId'] == NULL) {
                    $item['extraItemId'] = NULL;
                } else {
                    $item['extraItemId'] = $item['extraItemId'];
                }

                $foodData['order_id'] = $order->id;
                $foodData['food_id'] = $item['foodId'];
                $foodData['food_variant_id'] = $item['foodVariantId'];
                $foodData['food_price'] = $item['price'];
                $foodData['food_quantity'] = $item['quantity'];
                $foodData['extra_id'] = $item['extraItemId'];
                $foodData['extra_price'] = $item['extraItemPrice'] ? $item['extraItemPrice'] : 0;
                $foodData['sub_total'] = ($item['price'] * $item['quantity']) + $item['extraItemPrice'];

                $foodArray[] = $foodData;
            }


            OrderDetail::insert($foodArray);


            //SEND NOTIFICATION
            $orderId = $order->id;
            $foodName = FoodVariant::where('id', $item['foodVariantId'])->first()->name;
            $deviceToken = Restaurant::where('id', $orderData['restaurantId'])->first()->device_token;

            //SENT NOTIFICATION
            sendNotificationFCM($deviceToken, $orderId, $foodName, $orderFrom = 'Customer', 'NEW_ORDER_FOR_RESTAURANT');


            //POINT SAVE
            $pointData['customer_id'] = $orderData['customer_id'];
            $pointData['order_id'] = $order->id;
            $pointData['amount'] = doubleval($orderData['sub_total']);
            $pointData['point'] = doubleval(($orderData['sub_total'] * 10) / 100);

            Point::insert($pointData);

            $orderStatus = Order::with('RestaurantDetails')->where('id', $order->id)->orderBy('id', 'DESC')->first();

            if ($orderStatus) {
                return $this->sendResponse($orderStatus, 'My order list.', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
            }

        } else {
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }

    public function customerOrderDetails($orderId = '')
    {
        $orderStatus = Order::with('RestaurantDetails')->where('id', $orderId)->orderBy('id', 'DESC')->first();

        if ($orderStatus) {
            return $this->sendResponse($orderStatus, 'My order list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }


    public function myOrder(Request $request)
    {
        $myOrders = Order::with('orderDetails', 'orderDetails.foods')->where('customer_id', $request->customer_id)->orderBy('id', 'DESC')->get();

        if ($myOrders->count() > 0) {
            return $this->sendResponse($myOrders, 'My order list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }


    public function restaurantOrderList(Request $request)
    {
        $orders = Order::where('restaurant_id', $request->restaurant_id)->orderBy('id', 'DESC')->get();

        return $this->sendResponse($orders, 'Restaurant order list.', Response::HTTP_OK);
    }

    public function restaurantOrderUpdate(Request $request)
    {
        Order::where(["id" => $request->order_id])->update(
            [
                "order_status" => $request->order_status,
            ]
        );

        $order = Order::where('id', $request->order_id)->first();

        return $this->sendResponse($order, 'Order updated successfully.', Response::HTTP_OK);
    }


    //SHOP LIST
    public function shopList()
    {
        $shopPromotion = ShopPromotion::all();
        $shopList = Shop::all();

        if ($shopList->count() > 0) {

            $shopListDataArray = array();

            foreach ($shopList as $shop){
                $shopListData['id'] = $shop->id;
                $shopListData['image'] = $shop->image;
                $shopListData['name'] = $shop->name;
                $shopListData['delivery_fee'] = $shop->delivery_fee;
                $shopListData['description'] = $shop->description;
                $shopListData['ratting'] = $shop->ratting;
                $shopListData['coupon'] = $shop->coupon;
                $shopListData['delivery_time'] = $shop->delivery_time;
                $shopListData['is_favorite'] = $shop->isFavorite;

                $shopListDataArray[] = $shopListData;
            }

            $data = array(
                'message' => $shopPromotion[0]->message,
                'banner' => $shopPromotion[0]->image,
                'shops' => $shopListDataArray
            );
            return $this->sendResponse($data, 'Shop list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    //SHOP ITEM LIST
    public function shopItemList(Request $request)
    {
        $shopItemList = ShopItem::where('shop_id', $request->shop_id)->get();
        $shopDataArray = array();
        if ($shopItemList->count() > 0) {

            $banner = "http://rongtulibd.com/deliverydot/public/img/customer/default.png";

            $headerData['coupon'] = $shopItemList[0]['coupon'];
            $headerData['delivery_fee'] = $shopItemList[0]['delivery_fee'];
            $headerData['description'] = $shopItemList[0]['description'];
            $headerData['ratting'] = $shopItemList[0]['ratting'];
            $headerData['is_favorite'] = $shopItemList[0]['is_favorite'];

            foreach ($shopItemList as $shop){
                $shopData['image'] = $shop->image;
                $shopData['item_name'] = $shop->name;
                $shopData['price'] = $shop->price;
                $shopData['discount'] = $shop->discount;

                $shopDataArray[] = $shopData;
            }

            $data = array(
                'banner' => $banner,
                'promotion_data' => $headerData,
                'items' => $shopDataArray,
            );

            return $this->sendResponse($data, 'Shop item list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    //POINT LIST
    public function point(Request $request)
    {
        $points = Point::with('orders', 'orders.RestaurantDetails', 'orders.orderDetails', 'orders.orderDetails.foods', 'orders.orderDetails.foodVariants')
            ->where('customer_id', $request->customer_id)
            ->get();

        if ($points->count() > 0) {
            $pointsList = [];

            foreach ($points->toArray() as $key => $point) {

                $pointData['point'] = $point['point'] . ' PTS';
                $pointData['order_date'] = date('Y-m-d', strtotime($point['orders']['order_date']));
                $pointData['item'] = $point['orders']['order_details'][0]['foods']['name'] . ', ' . $point['orders']['order_details'][0]['food_variants'][0]['name'] . ', ' . $point['orders']['restaurant_details']['name'];

                $pointsList[] = $pointData;
            }


            $data = array(
                'earned_point' => $points->sum('point'),
                'points' => $pointsList

            );

            return $this->sendResponse($data, 'Point list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function helpAndSupport()
    {
        $helpAndSupport = HelpAndSupport::select('question', 'answer')->where('type', 'customer')->get();

        if ($helpAndSupport->count() > 0) {
            return $this->sendResponse($helpAndSupport, 'Help and support list', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function termsAndCondition()
    {
        $termsAndCondition = TermsAndCondition::where('type', 'customer')->first();

        if ($termsAndCondition) {
            return $this->sendResponse(strip_tags($termsAndCondition->description), 'Terms and condition list', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantDetails(Request $request)
    {
        $restaurantDetails = Restaurant::with('RestaurantDetails')->where('id', $request->restaurant_id)->first();

        if ($restaurantDetails) {
            return $this->sendResponse($restaurantDetails, 'Restaurant details.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }
}
