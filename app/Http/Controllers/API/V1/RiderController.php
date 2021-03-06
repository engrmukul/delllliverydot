<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RiderContract;
use App\Http\Requests\RiderAddressStoreFormRequest;
use App\Http\Requests\RiderAddressUpdateFormRequest;
use App\Http\Requests\RiderDeviceTokenStoreFormRequest;
use App\Http\Requests\RiderDocumentUpdateFormRequest;
use App\Http\Requests\RiderOrderDetailFormRequest;
use App\Http\Requests\RiderOrderListFormRequest;
use App\Http\Requests\RiderOrderStatusFormRequest;
use App\Http\Requests\RiderOTPVerificationFormRequest;
use App\Http\Requests\RiderPhoneVerificationFormRequest;
use App\Http\Requests\RiderStoreFormRequest;
use App\Http\Requests\RiderUpdateFormRequest;
use App\Models\HelpAndSupport;
use App\Models\Order;
use App\Models\Rider;
use App\Models\RiderAddress;
use App\Models\RiderProfile;
use App\Models\RiderSetting;
use App\Models\TermsAndCondition;
use App\Traits\UploadTrait;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

            event(new \App\Events\NewRegistration());

            return $this->sendResponse($rider, 'Rider saved successfully.', Response::HTTP_OK);
        } else {

            return $this->sendResponse(array(), 'Data not save', Response::HTTP_NOT_FOUND);
        }
    }

    protected function otpVerify(RiderOTPVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $rider = $this->riderRepository->riderOTPVerify($params);

        if ($rider) {
            return $this->sendResponse($rider, 'Rider phone number valid.',Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Rider code not valid', Response::HTTP_NOT_FOUND);
        }
    }

    public function documentUpdate(RiderDocumentUpdateFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/rider/', 100, 100);
        }

        $document = $this->riderRepository->updateDocument($params);

        $rider = Rider::where('id', $request->rider_id)->first();

        $riderProfile = RiderProfile::where('rider_id', $request->rider_id)->first();


        if ($document && $rider && $riderProfile) {

            $rider->image = $riderProfile->image;
            $rider->nid = $riderProfile->nid;
            $rider->address = $riderProfile->address;

            return $this->sendResponse($rider, 'Rider update successfully.', Response::HTTP_OK);
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

        //DELETE DEFAULT ADDRESS
        RiderAddress::where('address','address')->where("rider_id", $request->rider_id)->delete();

        if ($riderLocation->save()) {


            //UPDATE RIDER LAT LONG
            getLatLong($request->address, 'riders', $request->rider_id);

            if ($request->is_current_address == 'yes') {
                RiderAddress::where("id", '!=', $riderLocation->id)->where("rider_id", $request->rider_id)->update(
                    [
                        "is_current_address" => 'no',
                    ]
                );

                //Update profile address
                RiderProfile::where("rider_id", $request->rider_id)->update(
                    [
                        "address" => $riderLocation->address,
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
        //UPDATE RIDER LAT LONG
        getLatLong($request->address, 'riders', $request->rider_id);

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

            //Update profile address
            RiderProfile::where("rider_id", $request->rider_id)->update(
                [
                    "address" => $riderLocation->address,
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
                "rider_id" => $request->rider_id,
                "payment_status" => $status == 'delivered' ? "paid" : "not_paid"
            ]
        );

        event(new \App\Events\NewRegistration());

        $orderList = Order::with('customer','customerDetails','restaurant', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')
            ->where('rider_id', $request->rider_id)
            ->orderBy('order_date', 'DESC')
            ->limit(10)
            ->get();


        date_default_timezone_set("Asia/Dhaka");


        $orderDataArray = array();
        if ($orderList->count() > 0) {
            foreach ($orderList->toArray() as $order) {

                //CALCULATE REMAINING TIME
                $orderDate = strtotime($order['order_date']);
                $currentDate = strtotime(date('Y-m-d h:i:s'));

                $timeDiff = $currentDate-$orderDate;

                $time = date('i', $timeDiff);

                $leftTime = intval($order['restaurant_details']['delivery_time']) - intval($time);

                if($leftTime > 0){
                    $lt = $leftTime ." M";
                }else{
                    $lt = "0 M";
                }


                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];
                $orderData['delivery_time'] = $lt;

                if($order['order_status'] == 'on_the_way_to_restaurant') {
                    $orderData['name'] = $order['restaurant_details']['name'];
                    $orderData['address'] = $order['restaurant_details']['address'];
                    $orderData['phone_number'] = $order['restaurant']['phone_number'];
                    $orderData['latitude'] = $order['restaurant']['latitude'];
                    $orderData['longitude'] = $order['restaurant']['longitude'];
                }if($order['order_status'] == 'on_the_way_to_customer' || $order['order_status'] == 'delivered' ){
                    $orderData['name'] = $order['customer']['name'];
                    $orderData['address'] = $order['customer_details']['address'];
                    $orderData['phone_number'] = $order['customer']['phone_number'];
                    $orderData['latitude'] = $order['customer']['latitude'];
                    $orderData['longitude'] = $order['customer']['longitude'];
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
        date_default_timezone_set("Asia/Dhaka");


        $orderList = Order::with('customer','customerDetails','restaurant', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->where('rider_id', $request->rider_id)->orderBy('order_date', 'DESC')->get();

        $orderDataArray = array();
        if ($orderList->count() > 0) {

            foreach ($orderList->toArray() as $order) {

                //CALCULATE REMAINING TIME
                $orderDate = strtotime($order['order_date']);
                $currentDate = strtotime(date('Y-m-d h:i:s'));

                $timeDiff = $currentDate-$orderDate;

                $time = date('i', $timeDiff);

                $leftTime = intval($order['restaurant_details']['delivery_time']) - intval($time);

                if($leftTime > 0){
                    $lt = $leftTime ." M";
                }else{
                    $lt = "0 M";
                }


                $orderData['order_id'] = $order['id'];
                $orderData['order_status'] = $order['order_status'];
                $orderData['order_date'] = $order['order_date'];
               // $orderData['delivery_time'] = $order['restaurant_details']['delivery_time'];
                $orderData['delivery_time'] = $lt;

                if($order['order_status'] == 'on_the_way_to_restaurant') {
                    $orderData['name'] = $order['restaurant_details']['name'];
                    $orderData['address'] = $order['restaurant_details']['address'];
                    $orderData['phone_number'] = $order['restaurant']['phone_number'];
                    $orderData['latitude'] = $order['restaurant']['latitude'];
                    $orderData['longitude'] = $order['restaurant']['longitude'];
                }if($order['order_status'] == 'on_the_way_to_customer' || $order['order_status'] == 'delivered' ){
                    $orderData['name'] = $order['customer']['name'];
                    $orderData['address'] = $order['customer_details']['address'];
                    $orderData['phone_number'] = $order['customer']['phone_number'];
                    $orderData['latitude'] = $order['customer']['latitude'];
                    $orderData['longitude'] = $order['customer']['longitude'];
                }

                foreach ($order['order_details'] as $orderDetails) {
                    $orderData['food_name'] = $orderDetails['foods']['name'];
                }

                //dd($order['order_details']);

                $orderDataArray[] = $orderData;
            }

            //dd($orderDataArray);

            return $this->sendResponse($orderDataArray, 'Order List.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
        }
    }

    //DEVICE TOKEN
    public function saveDeviceToken(RiderDeviceTokenStoreFormRequest $request)
    {
        if(isset($request->device_token)){
            $tokenUpdate = Rider::where("phone_number", $request->phone_number)->update(
                [
                    "device_token" => $request->device_token
                ]
            );
        }

        $rider = Rider::where('phone_number', $request->phone_number)->first();

        if ($rider) {
            return $this->sendResponse($rider, 'Device token Updated.', Response::HTTP_OK);
        } else {
            return $this->sendResponse(array(), 'Device token not updated', Response::HTTP_NOT_FOUND);
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
        try {
            DB::beginTransaction();

            if ($request->file('image') != null) {

                $imageName = $this->saveImages($request->file('image'), 'img/rider/', 100, 100);

                $image = url('/') . '/public/img/rider/' . $imageName;
            } else {
                $image = url('/') . '/public/img/rider/default.png';
            }

            Rider::where("id", $request->rider_id)->update(
                [
                    "phone_number" => $request->phone_number,
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => $request->password,
                ]
            );

            if ($request->file('image') != null) {
                RiderProfile::where("rider_id", $request->rider_id)->update(
                    [
                        "image" => $image,
                        "address" => $request->address
                    ]
                );
            } else {
                RiderProfile::where("rider_id", $request->rider_id)->update(
                    [
                        "address" => $request->address
                    ]
                );
            }

            RiderAddress::where("rider_id", $request->rider_id)->update(
                [
                    "address" => $request->address,
                    "is_current_address" => "yes"
                ]
            );


            $rider = Rider::where('id', $request->rider_id)->first();
            $riderProfile = RiderProfile::where('rider_id', $request->rider_id)->first();

            $rider->image = $riderProfile->image;
            $rider->address = $riderProfile->address;

            DB::commit();

            if ($rider) {
                return $this->sendResponse($rider, 'Rider update successfully.', Response::HTTP_OK);
            } else {
                return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $exception) {
            DB::rollback();
            throw new InvalidArgumentException($exception->getMessage());
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

    public function helpAndSupport()
    {
        $helpAndSupport = HelpAndSupport::select('question','answer')->where('type','rider')->get();

        if($helpAndSupport->count() > 0){
            return $this->sendResponse($helpAndSupport, 'Help and support list',Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }

    public function termsAndCondition()
    {
        $termsAndCondition = TermsAndCondition::where('type','rider')->first();

        if($termsAndCondition){
            return $this->sendResponse(strip_tags($termsAndCondition->description), 'Terms and condition list',Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }
    }
}
