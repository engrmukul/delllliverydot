<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Dashboard;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Dashboard', 'dashboard');

        $totalRestaurants = Restaurant::all()->count();
        $totalRiders = Rider::all()->count();
        $totalCustomers = Customer::all()->count();
        $totalOrders = Order::all()->count();

        $customers = Customer::latest('id')->limit(5)->get();
        $restaurants = Restaurant::latest('id')->limit(5)->get();
        $riders = Rider::latest('id')->limit(5)->get();

        $orders = Order::with('customer', 'restaurant', 'rider')->latest('id')->limit(10)->get();

        return view('admin.dashboard.index', compact('customers','restaurants','riders','totalCustomers','orders','totalOrders', 'totalRestaurants','totalRiders'));
    }

    /**
     * SAVE ADMIN DEVICE TOKEN
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveToken(Request $request)
    {
        //dd($request->token);
        User::where('id',auth()->user()->id)->update(array('device_token'=>$request->token));
        return response()->json(['token saved successfully.']);
    }

}
