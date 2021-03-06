<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RestaurantContract;
use App\Http\Requests\DeliveryManagementFormRequest;
use App\Http\Requests\RestaurantAddressStoreFormRequest;
use App\Http\Requests\RestaurantAddressUpdateFormRequest;
use App\Http\Requests\RestaurantDeviceTokenStoreFormRequest;
use App\Http\Requests\RestaurantDocumentUpdateFormRequest;
use App\Http\Requests\RestaurantOTPVerificationFormRequest;
use App\Http\Requests\RestaurantPhoneVerificationFormRequest;
use App\Http\Requests\RestaurantStoreFormRequest;
use App\Http\Requests\RestaurantUpdateFormRequest;
use App\Http\Requests\RiderDeviceTokenStoreFormRequest;
use App\Models\Extra;
use App\Models\Food;
use App\Models\HelpAndSupport;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use App\Models\RestaurantAddress;
use App\Models\RestaurantProfile;
use App\Models\RestaurantSetting;
use App\Models\Rider;
use App\Models\TermsAndCondition;
use App\Traits\UploadTrait;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class RestaurantController extends BaseController
{
    use UploadTrait;

    /**
     * @var RestaurantContract
     */
    protected $restaurantRepository;

    /**
     * RestaurantController constructor.
     * @param RestaurantContract $restaurantRepository
     */
    public function __construct(RestaurantContract $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');

        $orderHistory = $this->restaurantRepository->listRestaurant($params['restaurant_id']);

        if ($orderHistory) {
            return $this->sendResponse($orderHistory, 'Restaurant retrieved successfully.', Response::HTTP_OK);
        }

        return $this->sendError('Unable to get data.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function restaurantTodayOrder(Request $request)
    {
        $todaysOrder = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')
            ->whereDate('order_date', '>=', date('Y-m-d'))
            ->where('restaurant_id', $request->restaurant_id)
            ->orderBy('order_date', 'DESC')
            ->get();

        $orderDataArray = array();
        if ($todaysOrder->count() > 0) {
            foreach ($todaysOrder->toArray() as $order) {

                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];
                $orderData['order_detail_url'] = "http://panel.deliverydot.com.bd/".$order['id'].'/view';

                foreach ($order['order_details'] as $orderDetails) {
                    $orderData['food_name'] = $orderDetails['foods']['name'];
                }

                $orderDataArray[] = $orderData;
            }

            return $this->sendResponse($orderDataArray, 'Order list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * ORDER DETAILS
     */
    public function orderDetails(Request $request)
    {
        $orderDetails = OrderDetail::with('foods','foodVariants')
            ->where('order_id', $request->order_id)
            ->get();

        $orderItemDetailsArray = array();

        if($orderDetails){
            foreach ($orderDetails as $order){

                $extra = Extra::whereIn('id', explode(",",$order->extra_id))->get(['name']);

                if($extra){
                    foreach ($extra as $key => $ex){
                        $a[$key] = $ex->name;
                    }
                }

                $orderItemData['item'] = $order->foodVariants[0]->name;
                $orderItemData['quantity'] = $order->food_quantity;
                $orderItemData['extra'] = isset($a) ? implode(", ",$a) : "";


                $orderItemDetailsArray[] = $orderItemData;
            }
        }


        //dd($orderItemDetailsArray);


        if($orderItemDetailsArray){
            return $this->sendResponse($orderItemDetailsArray, 'Order details.', Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }

    }



    public function orderAccept(Request $request)
    {
        //return $this->sendResponse(array(), $request->order_id, Response::HTTP_NOT_FOUND); exit;

        try {
            Order::where("id", $request->order_id)->update(
                [
                    "order_status" => ($request->order_status == 'accept') ? 'food_is_cooking' : 'order_placed',
                ]
            );

            $order = Order::with('customer')->where('id', $request->order_id)->first();

            event(new \App\Events\NewRegistration());

            //SEND FCM NOTIFICATION TO USER
            sendStatusNotificationFCM($order->customer->device_token, 'Your order accepted');

            $todaysOrder = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('restaurant_id', $request->restaurant_id)->orderBy('order_date', 'ASC')->get();

            $orderDataArray = array();
            if ($todaysOrder->count() > 0) {
                foreach ($todaysOrder->toArray() as $order) {

                    $orderData['order_id'] = $order['id'];
                    $orderData['order_status'] = $order['order_status'];
                    $orderData['order_date'] = $order['order_date'];

                    foreach ($order['order_details'] as $orderDetails) {
                        $orderData['food_name'] = $orderDetails['foods']['name'];
                    }

                    $orderDataArray[] = $orderData;
                }

                return $this->sendResponse($orderDataArray, 'Order List.', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }

    }

    public function orderCancel(Request $request)
    {
        Order::where("id", $request->order_id)->update(
            [
                "order_status" => ($request->order_status == 'canceled') ? 'canceled' : 'order_placed',
            ]
        );

        event(new \App\Events\NewRegistration());

        $todaysOrder = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('restaurant_id', $request->restaurant_id)->orderBy('order_date', 'ASC')->get();

        //SEND FCM NOTIFICATION TO USER
        sendStatusNotificationFCM($todaysOrder->customer->device_token, 'Your order canceled');

        $orderDataArray = array();
        if ($todaysOrder->count() > 0) {
            foreach ($todaysOrder->toArray() as $order) {

                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];

                foreach ($order['order_details'] as $orderDetails) {
                    $orderData['food_name'] = $orderDetails['foods']['name'];
                }

                $orderDataArray[] = $orderData;
            }

            return $this->sendResponse($orderDataArray, 'Order List.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function orderReady(Request $request)
    {
        $order = Order::where("id", $request->order_id)->update(
            [
                "order_status" => ($request->order_status == 'food_ready') ? 'food_ready' : 'food_is_cooking',
            ]
        );

        $restaurantId = Order::findOrFail($request->order_id)->restaurant_id;


        event(new \App\Events\NewRegistration());

        //SEND PUSH NOTIFICATION
        //GET 2 KM DISTANCE LAT LONG
        $currentAddress =  RestaurantAddress::where(['restaurant_id'=> $restaurantId, 'is_current_address'=>'yes'])->first();

        $latLongByAddress = latLongByAddress($currentAddress);
        $lat = $latLongByAddress['latitude'] ;
        $lon = $latLongByAddress['longitude'] ;
        $distance = getDistance();

        $riders = Rider::whereNotNull('device_token')
            ->selectRaw("*,

                ( 3959 * acos( cos( radians($lat) ) * cos( radians( riders.latitude ) )
                       * cos( radians(riders.longitude) - radians($lon)) + sin(radians($lat))
                       * sin( radians(riders.latitude)))) AS distance"
            )
            ->where('isVerified', '1')
            ->where('status', 'active')
            ->having("distance", "<", $distance)
            ->get();

        $orderDetail = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->where('id', $request->order_id)->first();


        //SEND FCM NOTIFICATION TO USER
        sendStatusNotificationFCM($orderDetail->customer->device_token, 'Your order on the way');


        $orderDataArray = array();

        $order_details = $orderDetail->toArray();

        $orderData['order_id'] = $orderId = $order_details['id'];
        $orderData['order_status'] = $order_details['order_status'];
        $orderData['restaurant_name'] = $orderFrom = $order_details['restaurant_details']['name'];
        $orderData['restaurant_address'] = $order_details['restaurant_details']['address'];


        foreach ($order_details['order_details'] as $order) {

            $orderData['food_name'] = $foodName = $order['foods']['name'];

            $orderDataArray[] = $orderData;
        }

        foreach ($riders as $key => $value) {

            sendNotificationFCM($value->device_token, $orderId, $foodName, $orderFrom, 'NEW_ORDER_FOR_DELIVERY');
        }

        $todaysOrder = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')
            ->where('restaurant_id', $request->restaurant_id)
            ->orderBy('order_date', 'DESC')
            ->limit(5)
            ->get();

        $orderDataArray = array();
        if ($todaysOrder->count() > 0) {
            foreach ($todaysOrder->toArray() as $order) {

                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];

                foreach ($order['order_details'] as $orderDetails) {
                    $orderData['food_name'] = $orderDetails['foods']['name'];
                }

                $orderDataArray[] = $orderData;
            }

            return $this->sendResponse($orderDataArray, 'Order List.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param RestaurantPhoneVerificationFormRequest $request
     * @return Response
     */
    public function store(RestaurantPhoneVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $restaurant = $this->restaurantRepository->createRestaurant($params);

        if ($restaurant) {

            event(new \App\Events\NewRegistration());

            return $this->sendResponse($restaurant, 'Restaurant saved successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param RestaurantOTPVerificationFormRequest $request
     * @return Response
     */
    protected function otpVerify(RestaurantOTPVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $restaurant = $this->restaurantRepository->restaurantOTPVerify($params);

        if ($restaurant) {
            return $this->sendResponse($restaurant, 'Restaurant phone number valid.', Response::HTTP_OK);
        } else {

            return $this->sendResponse(array(), 'Restaurant code not valid', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $restaurant = $this->restaurantRepository->findRestaurantById($id);

        if (!$restaurant) {
            return $this->sendResponse($restaurant, 'Restaurant retrieved successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * @param RestaurantUpdateFormRequest $request
     * @param Restaurant $restaurantModel
     * @return Response
     */
    public function restaurantProfileUpdate(RestaurantUpdateFormRequest $request, Restaurant $restaurantModel)
    {
        $params = $request->except('_token');

        $image = '';

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('nid')) . '_' . time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $image = $filePath;
        }

        $restaurant = $this->restaurantRepository->updateRestaurantProfile($params, $image);

        if ($restaurant) {
            return $this->sendResponse($restaurant, 'Restaurant update successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $restaurant = $this->restaurantRepository->deleteRestaurant($id, $params);

        if (!$restaurant) {
            return $this->sendResponse($restaurant, 'Restaurant delete successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function documentUpdate(Request $request)
    {
        $params = $request->except('_token');
        $image = '';

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('nid')) . '_' . time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $image = $filePath;
        }

        $document = $this->restaurantRepository->updateDocument($params, $image);

        if ($document) {
            return $this->sendResponse($document, 'Document update successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function settingsUpdate(Request $request)
    {
        $params = $request->except('_token');

        $this->restaurantRepository->settingsUpdate($params);

        $settings = RestaurantSetting::where('restaurant_id', $request->restaurant_id)->first();

        if ($settings->count() > 0) {
            return $this->sendResponse($settings, 'Restaurant settings update successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function storeCategory(Request $request)
    {
        $params = $request->except('_token');

        $category = $this->restaurantRepository->createCategory($params);

        if ($category) {
            return $this->sendResponse($category, 'Restaurant saved successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function categoryUpdate(Request $request)
    {
        $params = $request->except('_token');

        $category = $this->restaurantRepository->categoryUpdate($params);

        if ($category) {
            return $this->sendResponse($category, 'Category settings update successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function categoryDestroy(Request $request, $id)
    {
        $params = $request->except('_token');

        $category = $this->restaurantRepository->deleteCategory($id, $params);

        if ($category) {
            return $this->sendResponse($category, 'Category delete successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function restaurantLocation(Request $request)
    {
        $restaurantAddress = RestaurantAddress::where('restaurant_id', $request->restaurant_id)->orderBy('is_current_address', 'desc')->get();

        if ($restaurantAddress->count() > 0) {
            return $this->sendResponse($restaurantAddress, 'Restaurant address list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantLocationSave(RestaurantAddressStoreFormRequest $request)
    {
        $restaurantLocation = new RestaurantAddress();

        $restaurantLocation->restaurant_id = $request->restaurant_id;
        $restaurantLocation->address = $request->address;
        $restaurantLocation->is_current_address = $request->is_current_address;

        //DELETE DEFAULT ADDRESS
        RestaurantAddress::where('address', 'address')->where("restaurant_id", $request->restaurant_id)->delete();

        if ($restaurantLocation->save()) {


            //UPDATE RESTAURANT LAT LONG
            getLatLong($request->address, 'restaurants', $request->restaurant_id);

            if ($request->is_current_address == 'yes') {
                RestaurantAddress::where("id", '!=', $restaurantLocation->id)->where("restaurant_id", $request->restaurant_id)->update(
                    [
                        "is_current_address" => 'no',
                    ]
                );

                //Update profile address
                RestaurantProfile::where("restaurant_id", $request->restaurant_id)->update(
                    [
                        "address" => $restaurantLocation->address,
                    ]
                );
            }

            $restaurantAddress = RestaurantAddress::where('restaurant_id', $request->restaurant_id)->orderBy('is_current_address', 'desc')->get();

            if ($restaurantAddress->count() > 0) {
                return $this->sendResponse($restaurantAddress, 'Location saved', Response::HTTP_OK);

            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantLocationUpdate(RestaurantAddressUpdateFormRequest $request)
    {

        //UPDATE RESTAURANT LAT LONG
        getLatLong($request->address, 'restaurants', $request->restaurant_id);

        RestaurantAddress::where("id", $request->id)->update(
            [
                "restaurant_id" => $request->restaurant_id,
                "address" => $request->address,
                "is_current_address" => $request->is_current_address,
            ]
        );

        if ($request->is_current_address == 'yes') {
            RestaurantAddress::where("id", '!=', $request->id)->where("restaurant_id", $request->restaurant_id)->update(
                [
                    "is_current_address" => 'no',
                ]
            );

            //Update profile address
            RestaurantProfile::where("restaurant_id", $request->restaurant_id)->update(
                [
                    "address" => $request->address,
                ]
            );
        }

        $restaurantAddress = RestaurantAddress::where('restaurant_id', $request->restaurant_id)->orderBy('is_current_address', 'desc')->get();

        if ($restaurantAddress->count() > 0) {
            return $this->sendResponse($restaurantAddress, 'Location saved', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantLocationDelete(Request $request)
    {
        RestaurantAddress::where(['id' => $request->id, 'restaurant_id' => $request->restaurant_id])->delete();


        $restaurantAddress = RestaurantAddress::where('restaurant_id', $request->restaurant_id)->orderBy('is_current_address', 'desc')->get();

        if ($restaurantAddress->count() > 0) {
            return $this->sendResponse($restaurantAddress, 'Location saved', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantSelectedLocation(Request $request)
    {
        $restaurantAddress = RestaurantAddress::where(['restaurant_id' => $request->restaurant_id, 'is_current_address' => 'yes'])->first();

        if ($restaurantAddress) {
            return $this->sendResponse($restaurantAddress, 'Restaurant selected address', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function storeComplain(Request $request)
    {
        $params = $request->except('_token');

        $complain = $this->restaurantRepository->createComplain($params);

        if ($complain) {
            return $this->sendResponse($complain, 'Location saved successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function storeCoupon(Request $request)
    {
        $params = $request->except('_token');

        $coupon = $this->restaurantRepository->createCoupon($params);

        if ($coupon) {
            return $this->sendResponse($coupon, 'Coupon saved successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function couponUpdate(Request $request)
    {
        $params = $request->except('_token');

        $coupon = $this->restaurantRepository->couponUpdate($params);

        if ($coupon) {
            return $this->sendResponse($coupon, 'Coupon update successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function couponDestroy(Request $request, $id)
    {
        $params = $request->except('_token');

        $coupon = $this->restaurantRepository->deleteCoupon($id, $params);

        if ($coupon) {
            return $this->sendResponse($coupon, 'Coupon delete successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    //DEVICE TOKEN
    public function saveDeviceToken(RestaurantDeviceTokenStoreFormRequest $request)
    {
        if (isset($request->device_token)) {
            $tokenUpdate = Restaurant::where("phone_number", $request->phone_number)->update(
                [
                    "device_token" => $request->device_token
                ]
            );
        }

        $restaurant = Restaurant::where('phone_number', $request->phone_number)->first();

        if ($restaurant) {
            return $this->sendResponse($restaurant, 'Device token Updated.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Device token not updated', Response::HTTP_NOT_FOUND);
        }
    }

    public function restaurantFoodList(Request $request)
    {
        $restaurantFoodList = Food::where('restaurant_id', $request->restaurant_id)->get();

        if ($restaurantFoodList->count() > 0) {
            return $this->sendResponse($restaurantFoodList, 'Food list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function helpAndSupport()
    {
        $helpAndSupport = HelpAndSupport::select('question', 'answer')->where('type', 'restaurant')->get();

        if ($helpAndSupport->count() > 0) {
            return $this->sendResponse($helpAndSupport, 'Help and support list', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'No help and support', Response::HTTP_NOT_FOUND);
        }
    }

    public function termsAndCondition()
    {
        $termsAndCondition = TermsAndCondition::where('type', 'restaurant')->first();

        if ($termsAndCondition) {
            return $this->sendResponse(strip_tags($termsAndCondition->description), 'Terms and condition list', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'No terms and condition', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param deliveryManagementFormRequest $request
     */
    public function deliveryManagement(DeliveryManagementFormRequest $request)
    {
        $orders = Order::with('rider', 'orderDetails', 'orderDetails.foods')
                        ->where('restaurant_id', $request->restaurant_id)
                        ->where('rider_id', '!=', '')
                        ->get();

        $orderArray = $orders->toArray();

        $deliveryMngArray = array();

        if ($orderArray) {

            foreach ($orderArray as $index => $order) {

                $deliveryMng['deliveryDate'] = $order['order_date'];
                $deliveryMng['rider'] = $order['rider']['name'];
                $deliveryMng['order_status'] = $order['order_status'];
                $deliveryMng['food'] = $order['order_details'][0]['foods']['name'];

                $deliveryMngArray[] = $deliveryMng;
            }

            if ($deliveryMngArray) {
                return $this->sendResponse($deliveryMngArray, 'Delivery management', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'No delivery management', Response::HTTP_NOT_FOUND);
            }
        }else{
            return $this->sendResponse(array(), 'No delivery management', Response::HTTP_NOT_FOUND);
        }



    }
}
