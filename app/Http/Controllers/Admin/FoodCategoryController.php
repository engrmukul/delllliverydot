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
        $this->setPageTitle('food-categories', 'foodCategorys List');
        $data = [
            'tableHeads' => [
                trans('foodCategory.SN'),
                trans('foodCategory.name'),
                trans('foodCategory.status'),
                trans('foodCategory.action')
            ],
            'dataUrl' => 'admin/food-categories/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.foodCategories.index', $data);
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
        $this->setPageTitle('food-categories', 'create foodCategory');

        return view('admin.foodCategories.create');
    }

    /**
     * @param StoreFoodCategoryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FoodCategoryStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/foodCategory', 500, 500);
        }

        $foodCategory = $this->foodCategoryRepository->createFoodCategory($params);

        if (!$foodCategory) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('food-categories.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('food-categories', 'Edit FoodCategory');

        $foodCategory = $this->foodCategoryRepository->findFoodCategoryById($id);

        return view('admin.food-categories.edit', compact('foodCategory'));
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
        return $this->responseRedirect('food-categories.index', trans('common.update_success'), 'success', false, false);
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
        return $this->responseRedirect('food-categories.index', trans('common.delete_success'), 'success', false, false);
    }
}
