<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Rider;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Contracts\RiderContract;
use App\Http\Requests\RiderStoreFormRequest;
use App\Http\Requests\RiderUpdateFormRequest;

class RiderController extends BaseController
{

    /**
     * riderController constructor.
     * @param riderContract $riderRepository
     */
    public function __construct(riderContract $RiderRepository)
    {
        $this->RiderRepository = $RiderRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Riders', 'Riders List');
        $data = [
            'tableHeads' => [
                trans('rider.SN'),
                trans('rider.name'),
                trans('rider.email'),
                trans('rider.phone_number'),
                trans('rider.status'),
                trans('rider.action')
            ],
            'dataUrl' => 'admin/riders/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone_number', 'name' => 'phone_number'],
                ['data' => 'isVerified', 'name' => 'isVerified'],
                ['data' => 'email_verified_at', 'name' => 'email_verified_at'],
                ['data' => 'password', 'name' => 'password'],
                ['data' => 'remember_token', 'name' => 'remember_token'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'device_token', 'name' => 'device_token'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.riders.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->riderRepository->listRider($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Riders', 'Create Rider');

        $currentAddresses = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $notifications  = array(
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

        $orders = Order::all();

        return view('admin.riders.create', compact('currentAddresses','notifications', 'orders', 'popupNotifications', 'smses'));
    }

    /**
     * @param RiderStoreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RiderStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $rider = $this->RiderRepository->createRider($params);

        if (!$rider) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('riders.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('Riders', 'Edit Rider');

        $currentAddresses = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $notifications  = array(
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

        $orders = Order::all();

        $rider = $this->riderRepository->findRiderById($id);

        return view('admin.riders.edit', compact('currentAddresses','notifications','popupNotifications','smses','orders','rider'));
    }

    /**
     * @param RiderUpdateFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RiderUpdateFormRequest $request, Rider $riderModel)
    {
        $params = $request->except('_token');

        $rider = $this->riderRepository->updateRider($params);

        if (!$rider) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('riders.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $rider = $this->riderRepository->deleteRider($id, $params);

        if (!$rider) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('riders.index', trans('common.delete_success'), 'success', false, false);
    }
}
