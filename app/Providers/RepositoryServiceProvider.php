<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\CouponContract;
use App\Contracts\CustomerContract;
use App\Contracts\ExtraContract;
use App\Contracts\FoodContract;
use App\Contracts\OrderContract;
use App\Contracts\RestaurantContract;
use App\Contracts\RiderContract;
use App\Repositories\CategoryRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ExtraRepository;
use App\Repositories\FoodRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\RiderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CustomerContract::class => CustomerRepository::class,
        RiderContract::class => RiderRepository::class,
        RestaurantContract::class => RestaurantRepository::class,
        OrderContract::class => OrderRepository::class,
        CouponContract::class => CouponRepository::class,
        FoodContract::class => FoodRepository::class,
        CategoryContract::class => CategoryRepository::class,
        ExtraContract::class => ExtraRepository::class,

    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
