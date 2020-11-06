<?php

namespace App\Providers;

use App\Contracts\CustomerContract;
use App\Contracts\OrderContract;
use App\Contracts\RestaurantContract;
use App\Contracts\RiderContract;
use App\Repositories\CustomerRepository;
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
