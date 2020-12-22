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

        $deliveryTypes = array(
            'home' => 'home',
            'collect' => 'collect',
        );

        $closedRestaurants = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $availableForDeliveries = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $notifications = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $popupNotifications = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $smses = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $offerAndPromotions = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        return view('admin.restaurants.create', compact('deliveryTypes','closedRestaurants','availableForDeliveries','notifications','popupNotifications','smses','offerAndPromotions'));

    }

    /**
     * @param StoreRestaurantFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RestaurantStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/restaurant/', 500, 500);
        }

        $restaurant = $this->restaurantRepository->createRestaurantByAdmin($params);

        if (!$restaurant) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('restaurants.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('restaurants', 'Edit Restaurant');

        $restaurant = $this->restaurantRepository->findRestaurantById($id);

        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * @param UpdateRestaurantFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RestaurantUpdateFormRequest $request, Restaurant $RestaurantModel)
    {
        $params = $request->except('_token');

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/restaurant/', 500, 500);
        }

        $restaurant = $this->restaurantRepository->updateRestaurant($params);

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
}
