<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Dashboard;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Rider;

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

        return view('admin.dashboard.index', compact('totalCustomers','totalOrders', 'totalRestaurants','totalRiders'));
    }

}
