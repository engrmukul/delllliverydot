<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Contracts\CustomerContract;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;

class CustomerController extends BaseController
{
    /**
     * @var CustomerContract
     */
    protected $customerRepository;
    /**
     * @var CustomerContract
     */
    /**
     * customerController constructor.
     * @param customerContract $customerRepository
     */
    public function __construct(CustomerContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Customers', 'Customers List');
        $data = [
            'tableHeads' => [
                trans('customer.SN'),
                trans('customer.name'),
                trans('customer.email'),
                trans('customer.phone_number'),
                trans('customer.status'),
                trans('customer.action')
            ],
            'dataUrl' => 'admin/customers/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone_number', 'name' => 'phone_number'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.customers.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->customerRepository->listCustomer($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Customers', 'Create Customer');

        $notifications = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $offerAndPromotions = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $smses = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        return view('admin.customers.create', compact('notifications','offerAndPromotions', 'smses'));
    }

    /**
     * @param CustomerStoreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $customer = $this->customerRepository->createCustomer($params);

        if (!$customer) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('customers.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('Customers', 'Edit Customer');

        $notifications = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $offerAndPromotions = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $smses = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $customer = $this->customerRepository->findCustomerByIdByAdmin($id);

        return view('admin.customers.edit',compact('customer','notifications','offerAndPromotions', 'smses'));
    }

    /**
     * @param CustomerUpdateFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerUpdateFormRequest $request, Customer $customerModel)
    {
        $params = $request->except('_token');

        $customer = $this->customerRepository->updateCustomer($params);

        if (!$customer) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('customers.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $customer = $this->customerRepository->deleteCustomer($id, $params);

        if (!$customer) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('customers.index', trans('common.delete_success'), 'success', false, false);
    }
}
