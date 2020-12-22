<?php

namespace App\Http\Controllers\Admin;

use App\Models\Extra;
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
     * @param Request $request
     * @return mixed
     */
    public function requestedGetData(Request $request)
    {
        return $this->extraRepository->requestedExtra($request);
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
                trans('extra.name'),
                trans('extra.email'),
                trans('extra.phone_number'),
                trans('extra.isVerified'),
                trans('extra.status'),
                trans('extra.action')
            ],
            'dataUrl' => 'admin/extras/get-data',
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
        return view('admin.extras.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->extraRepository->allExtras($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('extras', 'create extra');

        $deliveryTypes = array(
            'home' => 'home',
            'collect' => 'collect',
        );

        $closedExtras = array(
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

        return view('admin.extras.create', compact('deliveryTypes','closedExtras','availableForDeliveries','notifications','popupNotifications','smses','offerAndPromotions'));

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

        $extra = $this->extraRepository->createExtraByAdmin($params);

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

        $extra = $this->extraRepository->findExtraById($id);

        return view('admin.extras.edit', compact('extra'));
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
