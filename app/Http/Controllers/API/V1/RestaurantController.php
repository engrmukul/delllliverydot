<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RestaurantContract;
use App\Http\Requests\RestaurantOTPVerificationFormRequest;
use App\Http\Requests\RestaurantPhoneVerificationFormRequest;
use App\Http\Requests\RestaurantStoreFormRequest;
use App\Http\Requests\RestaurantUpdateFormRequest;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantSetting;
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

        if($orderHistory){
            return $this->sendResponse($orderHistory, 'Restaurant retrieved successfully.',Response::HTTP_OK);
        }

        return $this->sendError('Unable to get data.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function restaurantTodayOrder(Request $request)
    {
        $todaysOrder = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('restaurant_id', $request->restaurant_id)->get();

        if($todaysOrder->count() > 0){
            return $this->sendResponse($todaysOrder, 'Restaurant retrieved successfully.',Response::HTTP_OK);
        }else{
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
            return $this->sendResponse($restaurant, 'Restaurant saved successfully.',Response::HTTP_OK);
        }else{

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
            return $this->sendResponse($restaurant, 'Restaurant phone number valid.',Response::HTTP_OK);
        }else{

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
            return $this->sendResponse($restaurant, 'Restaurant retrieved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * @param RestaurantUpdateFormRequest $request
     * @param Restaurant $restaurantModel
     * @return Response
     */
    public function restaurantProfileUpdate(RestaurantUpdateFormRequest $request, Restaurant $restaurantModel)
    {
        $params = $request->except('_token');

        $params['image'] = $this->saveImages($request->file('image'), 'img/restaurant/', 250,250);

        $restaurant = $this->restaurantRepository->updateRestaurantProfile($params);

        if ($restaurant) {
            return $this->sendResponse($restaurant, 'Restaurant update successfully.',Response::HTTP_OK);
        }else{
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
            return $this->sendResponse($restaurant, 'Restaurant delete successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $name = Str::slug($request->input('nid')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $image = $filePath;
        }

        $document = $this->restaurantRepository->updateDocument($params, $image);

        if ($document) {
            return $this->sendResponse($document, 'Document update successfully.',Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not updated', Response::HTTP_NOT_FOUND);
        }

    }

    public function orderAcceptCancel(Request $request)
    {

        Order::where("id", $request->order_id)->update(
            [
                "order_status" => ($request->order_status == 'accept') ? 'food_is_cooking' : 'order_placed',
            ]
        );

        $todaysOrder = Order::with('customer', 'RestaurantDetails', 'orderDetails', 'orderDetails.foods', 'orderDetails.foodVariants')->whereDate('order_date', '>=', date('Y-m-d'))->where('restaurant_id', $request->restaurant_id)->get();

        if($todaysOrder->count() > 0){
            return $this->sendResponse($todaysOrder, 'Restaurant retrieved successfully.',Response::HTTP_OK);
        }else{
            return $this->sendResponse(array(), 'Data not found', Response::HTTP_NOT_FOUND);
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
            return $this->sendResponse($restaurant, 'Restaurant settings update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

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
            return $this->sendResponse($category, 'Restaurant saved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
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
            return $this->sendResponse($category, 'Category settings update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

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
            return $this->sendResponse($category, 'Category delete successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function storeLocation(Request $request)
    {
        $params = $request->except('_token');

        $address = $this->restaurantRepository->createLocation($params);

        if ($address) {
            return $this->sendResponse($address, 'Location saved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function locationUpdate(Request $request)
    {
        $params = $request->except('_token');

        $address = $this->restaurantRepository->locationUpdate($params);

        if ($address) {
            return $this->sendResponse($address, 'Location update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function locationDestroy(Request $request, $id)
    {
        $params = $request->except('_token');

        $address = $this->restaurantRepository->deleteLocation($id, $params);

        if ($address) {
            return $this->sendResponse($address, 'Location delete successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
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
            return $this->sendResponse($complain, 'Location saved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
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
            return $this->sendResponse($coupon, 'Coupon saved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
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
            return $this->sendResponse($coupon, 'Coupon update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

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
            return $this->sendResponse($coupon, 'Coupon delete successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }


}
