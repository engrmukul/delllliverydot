<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RestaurantContract;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerProfile;
use App\Models\Delivery;
use App\Models\FavoriteFood;
use App\Models\Food;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;

class RestaurantController extends BaseController
{
    protected $restaurantRepository;

    public function __construct(RestaurantContract $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index()
    {
        $restaurants = new stdClass();

        $restaurants->favorite = $this->restaurantRepository->listRestaurant(1);
        $restaurants->discounted = $this->restaurantRepository->listRestaurant(2);
        $restaurants->trending = $this->restaurantRepository->listRestaurant(5);
        $restaurants->popular = $this->restaurantRepository->listRestaurant(6);

        return $this->sendResponse($restaurants, 'Restaurant retrieved successfully.',Response::HTTP_OK);
    }

    public function itemList(Request $request)
    {
        $items = Food::where('restaurant_id', $request->restaurant_id)->get();

        return $this->sendResponse($items, 'Items retrieved successfully.',Response::HTTP_OK);
    }

    public function myLocation(Request $request)
    {
        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->get();

        return $this->sendResponse($customerAddress, 'My location list.',Response::HTTP_OK);
    }

    public function myLocationSave(Request $request)
    {
        $myLocation = new CustomerAddress();

        $myLocation->customer_id = $request->customer_id;
        $myLocation->address  = $request->address;

        $myLocation->save();

        return $this->sendResponse($myLocation, 'Address added successfully.',Response::HTTP_OK);
    }

    public function myProfile(Request $request)
    {
        $customer = Customer::where('id', $request->customer_id)->first();
        $customer->address = CustomerAddress::select('address')->where('customer_id', $request->customer_id)->orderBy('id','DESC')->limit(1)->get();

        return $this->sendResponse($customer, 'Customer profile data.',Response::HTTP_OK);
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


        return $this->sendResponse(array(), 'Profile updated successfully.',Response::HTTP_OK);
    }

    public function myFavoriteFood(Request $request)
    {
        $favoriteFoods = FavoriteFood::with('foods')->where('customer_id', $request->customer_id)->get();

        return $this->sendResponse($favoriteFoods, 'My favorite items.',Response::HTTP_OK);
    }

    public function myDeliverySave(Request $request)
    {
        $myDelivery = new Delivery();

        $myDelivery->customer_id  = $request->customer_id;
        $myDelivery->from_name  = $request->from_name ;
        $myDelivery->from_phone  = $request->from_phone ;
        $myDelivery->from_email  = $request->from_email ;
        $myDelivery->from_address  = $request->from_address ;
        $myDelivery->to_name  = $request->to_name ;
        $myDelivery->to_phone  = $request->to_phone ;
        $myDelivery->to_email  = $request->to_email ;
        $myDelivery->to_address  = $request->to_address ;
        $myDelivery->to_area  = $request->to_area ;
        $myDelivery->to_district  = $request->to_district ;
        $myDelivery->to_post_code  = $request->to_post_code ;
        $myDelivery->item_name  = $request->item_name ;
        $myDelivery->item_type  = $request->item_type ;
        $myDelivery->width  = $request->width ;
        $myDelivery->height  = $request->height ;
        $myDelivery->length  = $request->length ;
        $myDelivery->weight  = $request->weight ;
        $myDelivery->instructions  = $request->instructions ;
        $myDelivery->pickup_time  = $request->pickup_time ;
        $myDelivery->status  = 'processing';

        $myDelivery->save();


        return $this->sendResponse($myDelivery, 'Delivery added successfully.',Response::HTTP_OK);
    }

    public function myDeliveryList(Request $request)
    {
        $deliverys = Delivery::where('customer_id', $request->customer_id)->get();

        return $this->sendResponse($deliverys, 'My delivery list.',Response::HTTP_OK);
    }

    public function settings(Request $request)
    {
        $settings = Setting::where('customer_id', $request->customer_id)->first();

        return $this->sendResponse($settings, 'Notification settings data.',Response::HTTP_OK);
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

        return $this->sendResponse($Setting, 'Seetings updated successfully.',Response::HTTP_OK);
    }


}
