<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RestaurantContract;
use App\Http\Requests\RestaurantAddressStoreFormRequest;
use App\Http\Requests\RestaurantAddressUpdateFormRequest;
use App\Http\Requests\RestaurantDeviceTokenStoreFormRequest;
use App\Http\Requests\RestaurantDocumentUpdateFormRequest;
use App\Http\Requests\RestaurantOTPVerificationFormRequest;
use App\Http\Requests\RestaurantPhoneVerificationFormRequest;
use App\Http\Requests\RestaurantStoreFormRequest;
use App\Http\Requests\RestaurantUpdateFormRequest;
use App\Http\Requests\RiderDeviceTokenStoreFormRequest;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantAddress;
use App\Models\RestaurantSetting;
use App\Models\Rider;
use App\Traits\UploadTrait;
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

            return $this->sendResponse($orderDataArray, 'Order list.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }

    }

    public function orderAccept(Request $request)
    {
        Order::where("id", $request->order_id)->update(
            [
                "order_status" => ($request->order_status == 'accept') ? 'food_is_cooking' : 'order_placed',
            ]
        );

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
    }

    public function orderCancel(Request $request)
    {
        Order::where("id", $request->order_id)->update(
            [
                "order_status" => ($request->order_status == 'canceled') ? 'canceled' : 'order_placed',
            ]
        );

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
    }

    public function orderReady(Request $request)
    {
        $order = Order::where("id", $request->order_id)->update(
            [
                "order_status" => ($request->order_status == 'food_ready') ? 'food_ready' : 'food_is_cooking',
            ]
        );

        $orderDetails =

            //SEND PUSH NOTIFICATION
        $riders = Rider::whereNotNull('device_token')->get();

        $orderDetail = Order::with('RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->where('id', $request->order_id)->first();

        $orderDataArray = array();

        $order_details = $orderDetail->toArray();

        $orderData['order_id'] = $orderId = $order_details['id'];
        $orderData['order_status'] = $order_details['order_status'];
        $orderData['restaurant_name'] = $restaurantName = $order_details['restaurant_details']['name'];
        $orderData['restaurant_address'] = $order_details['restaurant_details']['address'];


        foreach ($order_details['order_details'] as $order) {

            $orderData['food_name'] = $foodName = $order['foods']['name'];

            $orderDataArray[] = $orderData;
        }

        foreach ($riders as $key => $value) {

            $this->send_notification_FCM($value->device_token, $orderId, $foodName, $restaurantName);
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


    function send_notification_FCM($deviceToken, $orderId, $foodName, $restaurantName)
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
                "body": "New order from ' . $restaurantName . '",
                "click_action": "NEW_ORDER_FOR_DELIVERY"
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
            $result_noti = 0;
        } else {
            $result_noti = 1;
        }
        return $result_noti;
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

        $otp = $this->restaurantRepository->restaurantOTPVerify($params);

        $restaurant = Restaurant::where('phone_number', $request->phone_number)->first();

        if ($otp) {
            return $this->sendResponse($restaurant, 'Restaurant phone number valid.', Response::HTTP_OK);
        } else {

            return $this->sendResponse(array(), 'Data not verified', Response::HTTP_NOT_FOUND);
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

        $restaurant = $this->restaurantRepository->settingsUpdate($params);

        if ($restaurant) {
            return $this->sendResponse($restaurant, 'Restaurant settings update successfully.', Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);

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

        if ($restaurantLocation->save()) {
            if ($request->is_current_address == 'yes') {
                RestaurantAddress::where("id", '!=', $restaurantLocation->id)->where("restaurant_id", $request->restaurant_id)->update(
                    [
                        "is_current_address" => 'no',
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


}
