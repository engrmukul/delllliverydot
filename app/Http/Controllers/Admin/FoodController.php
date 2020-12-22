<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Contracts\FoodContract;
use App\Http\Requests\FoodStoreFormRequest;
use App\Http\Requests\FoodUpdateFormRequest;

class FoodController extends BaseController
{
    /**
     * @var FoodContract
     */
    protected $foodRepository;

    /**
     * FoodController constructor.
     * @param FoodContract $foodRepository
     */
    public function __construct(FoodContract $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function requestedGetData(Request $request)
    {
        return $this->foodRepository->requestedFood($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('foods', 'foods List');
        $data = [
            'tableHeads' => [
                trans('food.SN'),
                trans('food.name'),
                trans('food.email'),
                trans('food.phone_number'),
                trans('food.isVerified'),
                trans('food.status'),
                trans('food.action')
            ],
            'dataUrl' => 'admin/foods/get-data',
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
        return view('admin.foods.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->foodRepository->allFoods($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('foods', 'create food');

        $deliveryTypes = array(
            'home' => 'home',
            'collect' => 'collect',
        );

        $closedFoods = array(
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

        return view('admin.foods.create', compact('deliveryTypes','closedFoods','availableForDeliveries','notifications','popupNotifications','smses','offerAndPromotions'));

    }

    /**
     * @param StoreFoodFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FoodStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/food/', 500, 500);
        }

        $food = $this->foodRepository->createFoodByAdmin($params);

        if (!$food) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('foods.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('foods', 'Edit Food');

        $food = $this->foodRepository->findFoodById($id);

        return view('admin.foods.edit', compact('food'));
    }

    /**
     * @param UpdateFoodFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FoodUpdateFormRequest $request, Food $FoodModel)
    {
        $params = $request->except('_token');

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/food/', 500, 500);
        }

        $food = $this->foodRepository->updateFood($params);

        if (!$food) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('foods.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $food = $this->foodRepository->deleteFood($id, $params);

        if (!$food) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('foods.index', trans('common.delete_success'), 'success', false, false);
    }
}
