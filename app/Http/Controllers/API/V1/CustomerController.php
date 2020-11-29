<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\CustomerContract;
use App\Http\Requests\CustomerAddressStoreFormRequest;
use App\Http\Requests\CustomerAddressUpdateFormRequest;
use App\Http\Requests\CustomerOTPVerificationFormRequest;
use App\Http\Requests\CustomerPhoneVerificationFormRequest;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;
use App\Http\Requests\PromotionalRestaurantsRequest;
use App\Models\Banner;
use App\Models\Customer;
use App\Models\Extra;
use App\Models\FoodVariant;
use App\Models\PromotionalBanner;
use App\Models\Setting;
use App\Models\Shop;
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

    public function __index()
    {
        $customers = $this->customerRepository->listCustomer();

        return $this->sendResponse($customers, 'Customer retrieved successfully.', Response::HTTP_OK);
    }

    public function store(CustomerPhoneVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $customer = $this->customerRepository->createCustomer($params);

        if ($customer) {
            //$settings = new Setting();
            //$settings->customer_id = $customer->id;
            //$settings->save();


            return $this->sendResponse(array(), 'Welcome to DD.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function otpVerify(CustomerOTPVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $otp = $this->customerRepository->customerOTPVerify($params);

        $customer = Customer::where('phone_number', $request->phone_number)->first();

        if ($otp) {
            return $this->sendResponse($customer, 'Customer phone number valid.', Response::HTTP_OK);
        }
        return $this->sendError('Invalid verification code entered!.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public function edit($id)
    {
        $customer = $this->customerRepository->findCustomerById($id);

        if (!$customer) {
            return $this->sendResponse($customer, 'Customer retrieved successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    public function update(CustomerUpdateFormRequest $request, Customer $customerModel)
    {
        $params = $request->except('_token');

        $customer = $this->customerRepository->updateCustomer($params);

        if (!$customer) {
            return $this->sendResponse($customer, 'Customer update successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $customer = $this->customerRepository->deleteCustomer($id, $params);

        if (!$customer) {
            return $this->sendResponse($customer, 'Customer delete successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $restaurantList = $this->restaurantRepository->listRestaurant();

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

    public function restaurantPanel(Request $request)
    {
        $items = Food::with('categories', 'foodVariants')->where('restaurant_id', $request->restaurant_id)->get();

        $promotionalFoods = Food::with('coupon')->get();

        if ($items->count() > 0) {
            $allData = array();
            foreach ($items as $item) {
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
            /*$data = array(
                'title' => 'Address list',
                'addresses' => $customerAddress
            );*/
            return $this->sendResponse($customerAddress, 'Promotional restaurant list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }


    public function myProfile(Request $request)
    {
        $customer = Customer::where('id', $request->customer_id)->first();
        $customer->address = CustomerAddress::select('address')->where('customer_id', $request->customer_id)->orderBy('id', 'DESC')->limit(1)->get();

        return $this->sendResponse($customer, 'Customer profile data.', Response::HTTP_OK);
    }


    public function myProfileUpdate(Request $request)
    {
        Customer::where("id", $request->customer_id)->update(
            [
                "name" => $request->name,
                "email" => $request->email,
                "phone_number" => $request->phone_number,
            ]
        );

        CustomerAddress::where("customer_id", $request->customer_id)->update(
            [
                "address" => $request->address,
            ]
        );


        return $this->sendResponse(array(), 'Profile updated successfully.', Response::HTTP_OK);
    }

    public function myFavoriteFood(Request $request)
    {
        $favoriteFoods = FavoriteFood::with('foods')->where('customer_id', $request->customer_id)->get();

        return $this->sendResponse($favoriteFoods, 'My favorite items.', Response::HTTP_OK);
    }

    public function myDeliverySave(Request $request)
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

        $myDelivery->save();


        return $this->sendResponse($myDelivery, 'Delivery added successfully.', Response::HTTP_OK);
    }

    public function myDeliveryList(Request $request)
    {
        $deliverys = Delivery::where('customer_id', $request->customer_id)->get();

        return $this->sendResponse($deliverys, 'My delivery list.', Response::HTTP_OK);
    }

    public function settings(Request $request)
    {
        $settings = Setting::where('customer_id', $request->customer_id)->first();

        return $this->sendResponse($settings, 'Notification settings data.', Response::HTTP_OK);
    }


    public function settingsUpdate(Request $request)
    {
        Setting::where("customer_id", $request->customer_id)->update(
            [
                "notification" => $request->notification,
                "sms" => $request->sms,
                "offer_and_promotion" => $request->offer_and_promotion,
            ]
        );

        $Setting = Setting::where('customer_id', $request->customer_id)->first();

        return $this->sendResponse($Setting, 'Seetings updated successfully.', Response::HTTP_OK);
    }


    public function order(Request $request)
    {
        $order = new Order();

        $order->customer_id = $request->customer_id;
        $order->delivery_address = $request->delivery_address;
        $order->order_date = date('Y-m-d');
        $order->order_status = 'order_received';
        $order->payment_method = $request->payment_method;
        $order->payment_status = $request->payment_status;
        $order->total_price = $request->total_price;
        $order->discount = $request->discount;
        $order->vat = 0;
        $order->delivery_fee = $request->delivery_fee;
        $order->instructions = $request->instructions;
        $order->restaurant_id = $request->restaurant_id;
        $order->coupon_code = $request->coupon_code;

        $order->save();

        $foodArray = array();
        foreach ($request->food_id as $key => $item) {

            $foodData['order_id'] = $order->id;
            $foodData['food_id'] = $item;
            $foodData['food_variant_id'] = $item[$key]['food_variant_id'];
            $foodData['food_price'] = $item[$key]['food_price'];
            $foodData['food_quantity'] = $item[$key]['food_quantity'];
            $foodData['extra_id'] = $item[$key]['extra_id'];
            $foodData['extra_price'] = $item[$key]['extra_price'];
            $foodData['sub_total'] = $item[$key]['sub_total'];

            $foodArray[] = $foodData;
        }


        OrderDetail::insert($foodArray);


        return $this->sendResponse($order, 'Order added successfully.', Response::HTTP_OK);
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
        $shopList = Shop::all();

        if ($shopList->count() > 0) {
            $data = array(
                'shops' => $shopList
            );
            return $this->sendResponse($data, 'Shop list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    //SHOP ITEM LIST
    /*public function shopItemList()
    {
        $shopList = Shop::all();

        if ($shopList->count() > 0) {
            $data = array(
                'shops' => $shopList
            );
            return $this->sendResponse($data, 'Shop list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }*/


}
