<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\CustomerContract;
use App\Http\Requests\CustomerAddressStoreFormRequest;
use App\Http\Requests\CustomerAddressUpdateFormRequest;
use App\Http\Requests\CustomerOrderRequest;
use App\Http\Requests\CustomerOTPVerificationFormRequest;
use App\Http\Requests\CustomerPhoneVerificationFormRequest;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;
use App\Http\Requests\DeliveryStoreFormRequest;
use App\Http\Requests\PromoCodeRequest;
use App\Http\Requests\PromotionalRestaurantsRequest;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Extra;
use App\Models\FoodVariant;
use App\Models\Point;
use App\Models\PromotionalBanner;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\ShopItem;
use App\Models\ShopPromotion;
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

        //$otp = $this->customerRepository->customerOTPVerify($params);

        $customer = Customer::where('phone_number', $request->phone_number)->first();

        //will remove
        return $this->sendResponse($customer, 'Customer phone number valid.', Response::HTTP_OK);


//        if ($otp) {
//            return $this->sendResponse($customer, 'Customer phone number valid.', Response::HTTP_OK);
//        }
//        return $this->sendError('Invalid verification code entered!.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
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
        //$restaurantList = $this->restaurantRepository->listRestaurant();
        $restaurantList = Restaurant::with('RestaurantDetails', 'coupon', 'foods')->orderBy('id', 'DESC')->get();

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
            return $this->sendResponse($deliveries, 'My delivery list.', Response::HTTP_OK);
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


    public function settingsUpdate(Request $request)
    {
        Setting::where("customer_id", $request->customer_id)->update(
            [
                "notification" => $request->notification,
                "sms" => $request->sms,
                "offer_and_promotion" => $request->offer_and_promotion,
            ]
        );

        $settings = Setting::where('customer_id', $request->customer_id)->first();

        if ($settings) {
            return $this->sendResponse($settings, 'My settings.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
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

        if($orderData){
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

                if($item['extraItemId'] == 0 || $item['extraItemId'] == NULL) {
                    $item['extraItemId'] = NULL;
                }else{
                    $item['extraItemId'] = $item['extraItemId'];
                }

                $foodData['order_id'] = $order->id;
                $foodData['food_id'] = $item['foodId'];
                $foodData['food_variant_id'] = $item['foodVariantId'];
                $foodData['food_price'] = $item['price'];
                $foodData['food_quantity'] = $item['quantity'];
                $foodData['extra_id'] = $item['extraItemId'];
                $foodData['extra_price'] = $item['extraItemPrice'] ? $item['extraItemPrice'] : 0;
                $foodData['sub_total'] = ($item['price']*$item['quantity']) + $item['extraItemPrice'];

                $foodArray[] = $foodData;
            }


            OrderDetail::insert($foodArray);


            //SEND NOTIFICATION
            $orderId = $order->id;
            $foodName = FoodVariant::where('id', $item['foodVariantId'])->first()->name;
            $deviceToken = Restaurant::where('id',$orderData['restaurantId'])->first()->device_token;

            $this->send_notification_FCM($deviceToken, $orderId, $foodName);


            //POINT SAVE
            $pointData['customer_id'] = $orderData['customer_id'];
            $pointData['order_id'] = $order->id;
            $pointData['amount'] = doubleval($orderData['sub_total']);
            $pointData['point'] = doubleval(($orderData['sub_total'] * 10)/100);

            Point::insert($pointData);

            $orderStatus = Order::with('RestaurantDetails')->where('id', $order->id)->orderBy('id', 'DESC')->first();

            if($orderStatus)
            {
                return $this->sendResponse($orderStatus, 'My order list.', Response::HTTP_OK);
            }else{
                return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
            }

        }else{
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }

    public function send_notification_FCM($deviceToken, $orderId, $foodName)
    {
        $accesstoken = "key=AAAA6DftdWk:APA91bEwkeR1wHImQVk_ryC5Nfk8O1GK2E1dDamgTN-nzTStibnK2SFj5n2qkuXYIr8ZhU7hJlfLADmsq_HctdmEo_r4RJYNHot60RUo-Vmt2_ovvZUfKd3bCDqu-Q1OadOGa-VEisQZ";

        $URL = 'https://fcm.googleapis.com/fcm/send';

        $post_data = '{
            "to" : "' . $deviceToken . '",
            "data" : {
              "order_id" : "' . $orderId . '",
              "food_name" : "' . $foodName . '",
            },
            "notification" : {
                 "title": "New order",
                "body": "New order from  customer ' . $orderId . ' ",
                "click_action": "NEW_ORDER_FOR_RESTAURANT"
               },

          }';


        //print_r($post_data);die;

        $crl = curl_init();

        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: ' . $accesstoken;
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($crl, CURLOPT_URL, $URL);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

        $rest = curl_exec($crl);

        if ($rest === false) {
            // throw new Exception('Curl error: ' . curl_error($crl));
            //print_r('Curl error: ' . curl_error($crl));
            $result_noti = 0;
        } else {

            $result_noti = 1;
        }

        //curl_close($crl);
        //print_r($result_noti);die;
        return $result_noti;
    }

    public function customerOrderDetails($orderId='')
    {
        $orderStatus = Order::with('RestaurantDetails')->where('id', $orderId)->orderBy('id', 'DESC')->first();

        if($orderStatus)
        {
            return $this->sendResponse($orderStatus, 'My order list.', Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }


    public function myOrder(Request $request)
    {
        $myOrders = Order::with('orderDetails','orderDetails.foods')->where('customer_id', $request->customer_id)->orderBy('id', 'DESC')->get();

        if($myOrders->count() > 0)
        {
            return $this->sendResponse($myOrders, 'My order list.', Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
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
            $data = array(
                'message' => $shopPromotion[0]->message,
                'banner' => $shopPromotion[0]->image,
                'shops' => $shopList
            );
            return $this->sendResponse($data, 'Shop list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    //SHOP ITEM LIST
    public function shopItemList($shopId='')
    {
        $shopItemList = ShopItem::where('shop_id', $shopId)->get();

        if ($shopItemList->count() > 0) {
            return $this->sendResponse($shopItemList, 'Shop item list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    //POINT LIST
    public function point(Request $request)
    {
        $points = Point::with('orders','orders.RestaurantDetails', 'orders.orderDetails','orders.orderDetails.foods')
            ->where('customer_id', $request->customer_id)
            ->get();

        if ($points->count() > 0) {
            $data = array(
                'earned_point' => $points->sum('point'),
                'points_list' => $points
            );



            return $this->sendResponse($data, 'Point list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }


}
