<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('foods', 'foods List');
        $data = [
            'tableHeads' => [
                trans('food.SN'),
                trans('food.category'),
                trans('food.name'),
                trans('food.restaurant'),
                trans('food.status'),
                trans('food.action')
            ],
            'dataUrl' => 'admin/foods/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'category', 'name' => 'category'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'restaurant', 'name' => 'restaurant'],
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
        return $this->foodRepository->listFood($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('foods', 'create food');

        $features = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $deliverableFoods = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $restaurants = Restaurant::all();
        $categories = Category::all();

        return view('admin.foods.create', compact('features','deliverableFoods','restaurants','categories'));

    }

    /**
     * @param StoreFoodFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FoodStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/food/', 100, 100);
        }

        $food = $this->foodRepository->createFood($params);

        if (!$food) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }

        return redirect('admin/foods/'. $food->id .'/edit');
        //return $this->responseRedirect('foods.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('foods', 'Edit Food');
        $features = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $deliverableFoods = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $restaurants = Restaurant::all();
        $categories = Category::all();

        $food = $this->foodRepository->findFoodById($id);

        return view('admin.foods.edit', compact('food','features','deliverableFoods','restaurants','categories'));
    }
    /**
     * @param UpdateFoodFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FoodUpdateFormRequest $request, Food $FoodModel)
    {
        $params = $request->except('_token');

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/food/', 100, 100);
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
