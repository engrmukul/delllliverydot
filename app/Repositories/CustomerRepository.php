<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Contracts\CustomerContract;
use App\Models\CustomerAddress;
use App\Models\CustomerProfile;
use App\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerRepository extends BaseRepository implements CustomerContract
{
    /**
     * CustomerRepository constructor.
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCustomer(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('customers.edit', [$row->id]) . '" title="Customer Edit"><i class="fa fa-pencil"></i> ' . trans("common.edit") . '</a>';

                return $actions;
            })
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCustomerById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    public function findCustomerByIdByAdmin(int $id)
    {
        try {
            return $this->model->with('customerProfile','customerSetting','customerAddress')->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Customer|mixed
     */
    public function createCustomer(array $params)
    {
        try {
            DB::beginTransaction();

            $collection = collect($params);

            $phoneNumber = (substr($collection['phone_number'],0,3)=='+88') ? $collection['phone_number'] : '+88'.$collection['phone_number'];

            //SEND OTP
            if(sendOtpByTWILIO($phoneNumber) == true){
                //DEFAULT CUSTOMER DATA
                $maxId = Customer::where('id', '!=', '')->get()->count() + 1;
                $name = "Customer". $maxId;
                $email = 'customer'. $maxId .'@dd.com';
                $created_at = date('Y-m-d');

                $merge = $collection->merge(compact('name','email','created_at'));

                if( Customer::where('phone_number','=', $phoneNumber)->count() > 0){
                    return $customer = Customer::where('phone_number', $phoneNumber)->first();
                }

                //SAVE CUSTOMER
                $customer = new Customer($merge->all());
                $customer->save();

                //SAVE CUSTOMER PROFILE
                $customerProfile = new CustomerProfile();

                $customerProfile->customer_id = $customer->id;
                $customerProfile->image = url('/').'/public/img/customer/default.png';
                $customerProfile->dob = NULL;
                $customerProfile->spouse_dob = NULL;
                $customerProfile->father_dob = NULL;
                $customerProfile->mother_dob = NULL;
                $customerProfile->anniversary = NULL;
                $customerProfile->first_child_dob = NULL;
                $customerProfile->second_child_dob = NULL;
                $customerProfile->address = "Address";
                $customerProfile->short_biography = NULL;

                $customerProfile->save();

                //SAVE CUSTOMER ADDRESS
                $customerAddress = new CustomerAddress();

                $customerAddress->customer_id = $customer->id;
                $customerAddress->address = "Address";
                $customerAddress->is_current_address = 'yes';

                $customerAddress->save();

                //SAVE CUSTOMER SETTINGS
                $customerSetting = new Setting();

                $customerSetting->customer_id = $customer->id;
                $customerSetting->notification = 1;
                $customerSetting->sms = 1;
                $customerSetting->offer_and_promotion = 1;

                $customerSetting->save();

                DB::commit();

                return $customer;
            }else{
                return false;
            }

        } catch (QueryException $exception) {
            DB::rollback();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function customerOTPVerify(array $params)
    {
        try {
            $collection = collect($params);
            $phoneNumber = (substr($collection['phone_number'],0,3)=='+88') ? $collection['phone_number'] : '+88'.$collection['phone_number'];

            if (verifyOtpByTWILIO($phoneNumber, $collection['verification_code']) == true) {

                tap(Customer::where('phone_number', $phoneNumber))->update(['isVerified' => true]);

                return Customer::where('phone_number', $phoneNumber)->first();

            }else{
                return false;
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCustomer(array $params)
    {
        $customer = $this->findCustomerById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $customer->update($merge->all());

        return $customer;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCustomer($id, array $params)
    {
        $customer = $this->findCustomerById($id);

        $customer->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $customer->update($merge->all());

        return $customer;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }

    /**
     * @return mixed
     */
    public function getCustomerList()
    {
        return $this->shopWiseAllData();
    }

    public function settingsUpdate(array $params)
    {
        $settings = new Setting();

        $collection = collect($params)->except('_token');

        $customer_id = $collection['customer_id'];

        $merge = $collection->merge(compact('customer_id'));

        $affected = $settings->where('customer_id', $params['customer_id'])->update($merge->all());

        return $affected;
    }
}
