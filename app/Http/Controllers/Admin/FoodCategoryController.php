<?php

namespace App\Http\Controllers\Admin;

use App\Models\FoodCategory;
use Illuminate\Http\Request;
use App\Contracts\FoodCategoryContract;
use App\Http\Requests\FoodCategoryStoreFormRequest;
use App\Http\Requests\FoodCategoryUpdateFormRequest;

class FoodCategoryController extends BaseController
{
    /**
     * @var FoodCategoryContract
     */
    protected $foodCategoryRepository;

    /**
     * FoodCategoryController constructor.
     * @param FoodCategoryContract $foodCategoryRepository
     */
    public function __construct(FoodCategoryContract $foodCategoryRepository)
    {
        $this->foodCategoryRepository = $foodCategoryRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function requestedGetData(Request $request)
    {
        return $this->foodCategoryRepository->requestedFoodCategory($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('foodCategorys', 'foodCategorys List');
        $data = [
            'tableHeads' => [
                trans('foodCategory.SN'),
                trans('foodCategory.name'),
                trans('foodCategory.email'),
                trans('foodCategory.phone_number'),
                trans('foodCategory.isVerified'),
                trans('foodCategory.status'),
                trans('foodCategory.action')
            ],
            'dataUrl' => 'admin/foodCategorys/get-data',
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
        return view('admin.foodCategorys.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->foodCategoryRepository->allFoodCategorys($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('foodCategorys', 'create foodCategory');

        $deliveryTypes = array(
            'home' => 'home',
            'collect' => 'collect',
        );

        $closedFoodCategorys = array(
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

        return view('admin.foodCategorys.create', compact('deliveryTypes','closedFoodCategorys','availableForDeliveries','notifications','popupNotifications','smses','offerAndPromotions'));

    }

    /**
     * @param StoreFoodCategoryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FoodCategoryStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/foodCategory/', 500, 500);
        }

        $foodCategory = $this->foodCategoryRepository->createFoodCategoryByAdmin($params);

        if (!$foodCategory) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('foodCategorys.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('foodCategorys', 'Edit FoodCategory');

        $foodCategory = $this->foodCategoryRepository->findFoodCategoryById($id);

        return view('admin.foodCategorys.edit', compact('foodCategory'));
    }

    /**
     * @param UpdateFoodCategoryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FoodCategoryUpdateFormRequest $request, FoodCategory $FoodCategoryModel)
    {
        $params = $request->except('_token');

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/foodCategory/', 500, 500);
        }

        $foodCategory = $this->foodCategoryRepository->updateFoodCategory($params);

        if (!$foodCategory) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('foodCategorys.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $foodCategory = $this->foodCategoryRepository->deleteFoodCategory($id, $params);

        if (!$foodCategory) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('foodCategorys.index', trans('common.delete_success'), 'success', false, false);
    }
}
