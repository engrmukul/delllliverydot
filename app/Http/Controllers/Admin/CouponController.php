<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Contracts\CouponContract;
use App\Http\Requests\CouponStoreFormRequest;
use App\Http\Requests\CouponUpdateFormRequest;

class CouponController extends BaseController
{
    /**
     * @var CouponContract
     */
    protected $couponRepository;

    /**
     * CouponController constructor.
     * @param CouponContract $couponRepository
     */
    public function __construct(CouponContract $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Coupons', 'Coupons List');
        $data = [
            'tableHeads' => [
                trans('coupon.SN'),
                trans('coupon.code'),
                trans('coupon.total_code'),
                trans('coupon.total_used_code'),
                trans('coupon.expire_at'),
                trans('coupon.status'),
                trans('coupon.action')
            ],
            'dataUrl' => 'admin/coupons/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'code', 'name' => 'code'],
                ['data' => 'total_code', 'name' => 'total_code'],
                ['data' => 'total_used_code', 'name' => 'total_used_code'],
                ['data' => 'expire_at', 'name' => 'expire_at'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.coupons.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->couponRepository->listCoupon($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Coupons', 'Create Coupon');

        return view('admin.coupons.create');
    }

    /**
     * @param StoreCouponFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CouponStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $coupon = $this->couponRepository->createCoupon($params);

        if (!$coupon) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('coupons.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('Coupons', 'Edit Coupon');

        $coupon = $this->couponRepository->findCouponById($id);

        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * @param UpdateCouponFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CouponUpdateFormRequest $request, Coupon $couponModel)
    {
        $params = $request->except('_token');

        $coupon = $this->couponRepository->updateCoupon($params);

        if (!$coupon) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('coupons.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $coupon = $this->couponRepository->deleteCoupon($id, $params);

        if (!$coupon) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('coupons.index', trans('common.delete_success'), 'success', false, false);
    }
}
