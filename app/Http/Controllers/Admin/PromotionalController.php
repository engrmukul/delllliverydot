<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Promotional;
use Illuminate\Http\Request;
use App\Contracts\PromotionalContract;
use App\Http\Requests\PromotionalStoreFormRequest;
use App\Http\Requests\PromotionalUpdateFormRequest;

class PromotionalController extends BaseController
{
    /**
     * @var PromotionalContract
     */
    protected $promotionalRepository;
    /**
     * @var PromotionalContract
     */
    /**
     * customerController constructor.
     * @param PromotionalContract $promotionalRepository
     */
    public function __construct(PromotionalContract $promotionalRepository)
    {
        $this->promotionalRepository = $promotionalRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Promotionals', 'Promotionals List');
        $data = [
            'tableHeads' => [
                trans('promotional.SN'),
                trans('promotional.name'),
                trans('promotional.status'),
                trans('promotional.action')
            ],
            'dataUrl' => 'admin/promotionals/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('admin.promotionals.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->promotionalRepository->listPromotional($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Promotionals', 'Create Promotional');

        return view('admin.promotionals.create');
    }

    /**
     * @param PromotionalStoreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PromotionalStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $params['image'] = $this->saveImages($request->file('image'), 'img/banner/', 400,100);

        $promotional = $this->promotionalRepository->createPromotional($params);

        if (!$promotional) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }

        return redirect('admin/promotionals/'. $promotional->id .'/edit');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('Promotionals', 'Edit Promotional');

        $promotional = $this->promotionalRepository->findPromotionalById($id);

        return view('admin.promotionals.edit',compact('promotional'));
    }

    /**
     * @param PromotionalUpdateFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PromotionalUpdateFormRequest $request, Promotional $customerModel)
    {
        $params = $request->except('_token');

        if($request->has('image')){

            $params['image'] = $this->saveImages($request->file('image'), 'img/banner/', 400,100);
        }

        $promotional = $this->promotionalRepository->updatePromotional($params);

        if (!$promotional) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('promotionals.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $promotional = $this->promotionalRepository->deletePromotional($id, $params);

        if (!$promotional) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('promotionals.index', trans('common.delete_success'), 'success', false, false);
    }
}
