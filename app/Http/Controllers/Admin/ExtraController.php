<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Extra;
use App\Models\ExtraGroup;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Contracts\ExtraContract;
use App\Http\Requests\ExtraStoreFormRequest;
use App\Http\Requests\ExtraUpdateFormRequest;

class ExtraController extends BaseController
{
    /**
     * @var ExtraContract
     */
    protected $extraRepository;

    /**
     * ExtraController constructor.
     * @param ExtraContract $extraRepository
     */
    public function __construct(ExtraContract $extraRepository)
    {
        $this->extraRepository = $extraRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('extras', 'extras List');
        $data = [
            'tableHeads' => [
                trans('extra.SN'),
                trans('extra.group'),
                trans('extra.name'),
                trans('extra.price'),
                trans('extra.food'),
                trans('extra.status'),
                trans('extra.action')
            ],
            'dataUrl' => 'admin/extras/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'group', 'name' => 'group'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'price', 'name' => 'price'],
                ['data' => 'food', 'name' => 'food'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.extras.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->extraRepository->listExtra($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('extras', 'create extra');

        $groups = ExtraGroup::all();

        $foods = Food::all();

        return view('admin.extras.create', compact('groups','foods'));
    }

    /**
     * @param StoreExtraFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ExtraStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/extra/', 500, 500);
        }

        $extra = $this->extraRepository->createExtra($params);

        if (!$extra) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('extras.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('extras', 'Edit Extra');
        $groups = ExtraGroup::all();

        $foods = Food::all();

        $extra = $this->extraRepository->findExtraById($id);

        return view('admin.extras.edit', compact('extra','groups','foods'));
    }

    /**
     * @param UpdateExtraFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ExtraUpdateFormRequest $request, Extra $ExtraModel)
    {
        $params = $request->except('_token');

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/extra/', 500, 500);
        }

        $extra = $this->extraRepository->updateExtra($params);

        if (!$extra) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('extras.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $extra = $this->extraRepository->deleteExtra($id, $params);

        if (!$extra) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('extras.index', trans('common.delete_success'), 'success', false, false);
    }
}
