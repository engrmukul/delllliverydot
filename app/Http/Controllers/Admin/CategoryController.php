<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Http\Requests\CategoryStoreFormRequest;
use App\Http\Requests\CategoryUpdateFormRequest;

class CategoryController extends BaseController
{
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categoryRepository
     */
    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Categories', 'Category List');
        $data = [
            'tableHeads' => [
                trans('category.SN'),
                trans('category.name'),
                trans('category.status'),
                trans('category.action')
            ],
            'dataUrl' => 'admin/categories/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.categories.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->categoryRepository->listCategory($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Categories', 'Create Category');

        return view('admin.categories.create');
    }

    /**
     * @param StoreCategoryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/category/', 500, 500);
        }

        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('categories.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('Categories', 'Edit Category');

        $category = $this->categoryRepository->findCategoryById($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @param UpdateCategoryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateFormRequest $request, Category $categoryModel)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/category/', 500, 500);
        }

        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('categories.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $category = $this->categoryRepository->deleteCategory($id, $params);

        if (!$category) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('categories.index', trans('common.delete_success'), 'success', false, false);
    }
}
