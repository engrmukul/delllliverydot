<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RiderContract;
use App\Http\Requests\RiderAddressStoreFormRequest;
use App\Http\Requests\RiderAddressUpdateFormRequest;
use App\Http\Requests\RiderDocumentUpdateFormRequest;
use App\Http\Requests\RiderOrderDetailFormRequest;
use App\Http\Requests\RiderOrderListFormRequest;
use App\Http\Requests\RiderOrderStatusFormRequest;
use App\Http\Requests\RiderOTPVerificationFormRequest;
use App\Http\Requests\RiderPhoneVerificationFormRequest;
use App\Http\Requests\RiderStoreFormRequest;
use App\Http\Requests\RiderUpdateFormRequest;
use App\Models\Order;
use App\Models\Rider;
use App\Models\RiderAddress;
use App\Models\RiderProfile;
use App\Models\RiderSetting;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class RiderController extends BaseController
{
    use UploadTrait;

    protected $riderRepository;

    public function __construct(RiderContract $riderRepository)
    {
        $this->riderRepository = $riderRepository;
    }

    public function index(Request $request)
    {
        $params = $request->except('_token');

        $orderHistory = $this->riderRepository->listRider($params['rider_id']);

        if($orderHistory){
            return $this->sendResponse($orderHistory, 'Rider retrieved successfully.',Response::HTTP_OK);
        }

        return $this->sendError('Unable to get data.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function riderTodayOrder(Request $request)
    {
        $params = $request->except('_token');

        $todaysOrder = $this->riderRepository->listRiderTodayOrder($params['rider_id']);

        if($todaysOrder){
            return $this->sendResponse($todaysOrder, 'Rider retrieved successfully.',Response::HTTP_OK);
        }

        return $this->sendError('Unable to get data.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function store(RiderPhoneVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $rider = $this->riderRepository->createRider($params);

        if ($rider) {
            return $this->sendResponse($rider, 'Rider saved successfully.', Response::HTTP_OK);
        } else {

            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }

    protected function otpVerify(RiderOTPVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $otp = $this->riderRepository->riderOTPVerify($params);

        $rider = Rider::where('phone_number', $request->phone_number)->first();

        if ($otp) {
            return $this->sendResponse($rider, 'Rider phone number valid.',Response::HTTP_OK);
        }
        return $this->sendError('Invalid verification code entered!.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function documentUpdate(RiderDocumentUpdateFormRequest $request)
    {
        $params = $request->except('_token');
        $image = '';

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('nid')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $image = $filePath;
        }

        $document = $this->riderRepository->updateDocument($params, $image);

        if ($document) {
            return $this->sendResponse($document, 'Rider update successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }

    public function riderLocation(Request $request)
    {
        $riderAddress = RiderAddress::where('rider_id', $request->rider_id)->orderBy('is_current_address', 'desc')->get();

        if ($riderAddress->count() > 0) {
            return $this->sendResponse($riderAddress, 'Rider address list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function riderLocationSave(RiderAddressStoreFormRequest $request)
    {
        $riderLocation = new RiderAddress();

        $riderLocation->rider_id = $request->rider_id;
        $riderLocation->address = $request->address;
        $riderLocation->is_current_address = $request->is_current_address;

        if ($riderLocation->save()) {
            if ($request->is_current_address == 'yes') {
                RiderAddress::where("id", '!=', $riderLocation->id)->where("rider_id", $request->rider_id)->update(
                    [
                        "is_current_address" => 'no',
                    ]
                );
            }

            $riderAddress = RiderAddress::where('rider_id', $request->rider_id)->orderBy('is_current_address', 'desc')->get();

            if ($riderAddress->count() > 0) {
                return $this->sendResponse($riderAddress, 'Rider address list', Response::HTTP_OK);

            } else {
                return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
            }
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function riderLocationUpdate(RiderAddressUpdateFormRequest $request)
    {
        RiderAddress::where("id", $request->id)->update(
            [
                "rider_id" => $request->rider_id,
                "address" => $request->address,
                "is_current_address" => $request->is_current_address,
            ]
        );

        if ($request->is_current_address == 'yes') {
            RiderAddress::where("id", '!=', $request->id)->where("rider_id", $request->rider_id)->update(
                [
                    "is_current_address" => 'no',
                ]
            );
        }

        $riderAddress = RiderAddress::where('rider_id', $request->rider_id)->orderBy('is_current_address', 'desc')->get();

        if ($riderAddress->count() > 0) {
            return $this->sendResponse($riderAddress, 'Rider address list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function riderLocationDelete(Request $request)
    {
        RiderAddress::where(['id' => $request->id, 'rider_id' => $request->rider_id])->delete();


        $riderAddress = RiderAddress::where('rider_id', $request->rider_id)->orderBy('is_current_address', 'desc')->get();

        if ($riderAddress->count() > 0) {
            return $this->sendResponse($riderAddress, 'Rider address list', Response::HTTP_OK);

        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function riderSelectedLocation(Request $request)
    {
        $riderAddress = RiderAddress::where(['rider_id' => $request->rider_id, 'is_current_address' => 'yes'])->first();

        if ($riderAddress) {
            return $this->sendResponse($riderAddress, 'Rider selected address', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function orderDetail(RiderOrderDetailFormRequest $request)
    {
        $orderDetail = Order::with('RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->where('id', $request->order_id)->first();

        //dd($orderDetail->toArray());
        $orderDataArray = array();
        if ($orderDetail) {
            $order_details = $orderDetail->toArray();

            $orderData['order_id'] = $order_details['id'];
            $orderData['order_status'] = $order_details['order_status'];
            $orderData['restaurant_name'] = $order_details['restaurant_details']['name'];
            $orderData['restaurant_address'] = $order_details['restaurant_details']['address'];


            foreach ($order_details['order_details'] as $order) {

                $orderData['food_name'] = $order['foods']['name'];

                $orderDataArray[] = $orderData;
            }

            return $this->sendResponse($orderDataArray, 'Order data', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function orderStatus(RiderOrderStatusFormRequest $request)
    {
        $status = '';
        if($request->order_status == 'accept'){
            $status = 'rider_accepted';
        }
        if($request->order_status == 'collect'){
            $status = 'delivery_on_the_way';
        }
        if($request->order_status == 'delivered'){
            $status = 'delivered';
        }

        $orderUpdated = Order::where("id", $request->order_id)->update(
            [
                "order_status" => $status ? $status : 'food_ready',
                "rider_id" => $request->rider_id
            ]
        );

        $orderList = Order::with('customer','customerDetails','restaurant', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('rider_id', $request->rider_id)->orderBy('order_date', 'DESC')->get();

        $orderDataArray = array();
        if ($orderList->count() > 0) {
            foreach ($orderList->toArray() as $order) {

                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];
                $orderData['delivery_time'] = $order['restaurant_details']['delivery_time'];

                if($order['order_status'] == 'rider_accepted') {
                    $orderData['name'] = $order['restaurant_details']['name'];
                    $orderData['address'] = $order['restaurant_details']['address'];
                    $orderData['phone_number'] = $order['restaurant']['phone_number'];
                }if($order['order_status'] == 'delivery_on_the_way' || $order['order_status'] == 'delivered' ){
                    $orderData['name'] = $order['customer']['name'];
                    $orderData['address'] = $order['customer_details']['address'];
                    $orderData['phone_number'] = $order['customer']['phone_number'];
                }

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

    public function orderList(RiderOrderListFormRequest $request)
    {
        $orderList = Order::with('customer','customerDetails','restaurant', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('rider_id', $request->rider_id)->orderBy('order_date', 'DESC')->get();

        $orderDataArray = array();
        if ($orderList->count() > 0) {
            foreach ($orderList->toArray() as $order) {

                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];
                $orderData['delivery_time'] = $order['restaurant_details']['delivery_time'];

                if($order['order_status'] == 'rider_accepted') {
                    $orderData['name'] = $order['restaurant_details']['name'];
                    $orderData['address'] = $order['restaurant_details']['address'];
                    $orderData['phone_number'] = $order['restaurant']['phone_number'];
                }if($order['order_status'] == 'delivery_on_the_way' || $order['order_status'] == 'delivered' ){
                    $orderData['name'] = $order['customer']['name'];
                    $orderData['address'] = $order['customer_details']['address'];
                    $orderData['phone_number'] = $order['customer']['phone_number'];
                }

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

    public function orderHistory(Request $request)
    {
        $orderHistory = Order::select('id','order_date','delivery_address')->where('rider_id', $request->rider_id)->orderBy('order_date', 'ASC')->get();

        if ($orderHistory->count() > 0) {
            return $this->sendResponse($orderHistory, 'Order List.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function riderProfileUpdate(RiderUpdateFormRequest $request, Rider $riderModel)
    {
        $params = $request->except('_token');

        $image = '';

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('phone_number')) . '_' . time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $image = $filePath;
        }

        Rider::where("id", $request->rider_id)->update(
            [
                "phone_number" => $request->phone_number,
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
            ]
        );

        if($image !=''){
            RiderProfile::where("rider_id", $request->rider_id)->update(
                [
                    "image" => $image ? url('/').'/public'.$image : url('/').'/public/uploads/images/default.png' ,
                    "address" => $request->address
                ]
            );
        }else{
            RiderProfile::where("rider_id", $request->rider_id)->update(
                [
                    "address" => $request->address
                ]
            );
        }


        $rider = Rider::where('id', $request->rider_id)->first();
        $riderProfile = RiderProfile::where('rider_id', $request->rider_id)->first();

        $rider->image = $riderProfile->image;
        $rider->address = $riderProfile->address;

        if ($rider) {
            return $this->sendResponse($rider, 'Rider update successfully.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }

    public function settingsUpdate(Request $request)
    {
        $params = $request->except('_token');

        $this->riderRepository->settingsUpdate($params);

        $settings = RiderSetting::where('rider_id', $request->rider_id)->first();

        if ($settings->count() > 0) {
            return $this->sendResponse($settings, 'Rider settings update successfully.',Response::HTTP_OK);
        }else {
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }
}
