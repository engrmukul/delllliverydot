<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Contracts\RestaurantContract;
use App\Http\Requests\RestaurantStoreFormRequest;
use App\Http\Requests\RestaurantUpdateFormRequest;

class RestaurantController extends BaseController
{
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requestedRestaurant()
    {
        $this->setPageTitle('restaurants', 'restaurants List');
        $data = [
            'tableHeads' => [
                trans('restaurant.SN'),
                trans('restaurant.name'),
                trans('restaurant.email'),
                trans('restaurant.phone_number'),
                trans('restaurant.isVerified'),
                trans('restaurant.status'),
                trans('restaurant.action')
            ],
            'dataUrl' => 'admin/restaurants/requested-get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone_number', 'name' => 'phone_number'],
                ['data' => 'isVerified', 'name' => 'isVerified'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.restaurants.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function requestedGetData(Request $request)
    {
        return $this->restaurantRepository->requestedRestaurant($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('restaurants', 'restaurants List');
        $data = [
            'tableHeads' => [
                trans('restaurant.SN'),
                trans('restaurant.image'),
                trans('restaurant.name'),
                trans('restaurant.email'),
                trans('restaurant.phone_number'),
                trans('restaurant.isVerified'),
                trans('restaurant.status'),
                trans('restaurant.action')
            ],
            'dataUrl' => 'admin/restaurants/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'image', 'name' => 'image'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone_number', 'name' => 'phone_number'],
                ['data' => 'isVerified', 'name' => 'isVerified'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.restaurants.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->restaurantRepository->allRestaurants($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('restaurants', 'create restaurant');

        $closedRestaurants = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        return view('admin.restaurants.create', compact('closedRestaurants'));

    }

    /**
     * @param StoreRestaurantFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RestaurantStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if($request->is_favorite == null){
            $params['is_favorite'] = 'no';
        }
        if($request->is_discounted == null){
            $params['discount'] = 0.00;
            $params['is_discounted'] = 'no';
        }
        if($request->is_trending == null){
            $params['is_trending'] = 'no';
        }
        if($request->is_popular == null){
            $params['is_popular'] = 'no';
        }

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/restaurant/', 200, 200);
        }

        $restaurant = $this->restaurantRepository->createRestaurantByAdmin($params);

        if (!$restaurant) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }

        event(new \App\Events\NewRegistration());

        return redirect('admin/restaurants/'. $restaurant->id .'/edit');

        //return $this->responseRedirect('restaurants.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('restaurants', 'Edit Restaurant');

        $closedRestaurants = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $statuses = array(
            'active' => 'Active',
            'inactive' => 'Inactive',
        );

        $restaurant = $this->restaurantRepository->findRestaurantByIdByAdmin($id);

        return view('admin.restaurants.edit',  compact('restaurant','closedRestaurants','statuses'));
    }

    /**
     * @param UpdateRestaurantFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RestaurantUpdateFormRequest $request, Restaurant $RestaurantModel)
    {
        $params = $request->except('_token');

        if($request->status == null){
            $params['status'] = 'inactive';
        }
        if($request->is_favorite == null){
            $params['is_favorite'] = 'no';
        }
        if($request->is_discounted == null){
            $params['discount'] = 0.00;
            $params['is_discounted'] = 'no';
        }
        if($request->is_trending == null){
            $params['is_trending'] = 'no';
        }
        if($request->is_popular == null){
            $params['is_popular'] = 'no';
        }

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/restaurant/', 200, 200);
        }

        $restaurant = $this->restaurantRepository->updateRestaurantByAdmin($params);

        if (!$restaurant) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('restaurants.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $restaurant = $this->restaurantRepository->deleteRestaurant($id, $params);

        if (!$restaurant) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('restaurants.index', trans('common.delete_success'), 'success', false, false);
    }

    /**
     * RESTAURANT REVIEW
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review()
    {
        $this->setPageTitle('review', 'review List');
        $data = [
            'tableHeads' => [
                trans('review.SN'),
                trans('review.customer_phone'),
                trans('review.restaurant'),
                trans('review.restaurant_phone'),
                trans('review.rate'),
            ],
            'dataUrl' => 'admin/restaurants/review-get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'customer_phone', 'name' => 'customer_phone'],
                ['data' => 'restaurant', 'name' => 'restaurant'],
                ['data' => 'restaurant_phone', 'name' => 'restaurant_phone'],
                ['data' => 'rate', 'name' => 'rate'],
            ],
        ];
        return view('admin.restaurants.review', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reviewGetData(Request $request)
    {
        return $this->restaurantRepository->restaurantReview($request);
    }
}
