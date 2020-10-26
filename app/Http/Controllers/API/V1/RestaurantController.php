<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RestaurantContract;
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
}
