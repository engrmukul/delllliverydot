<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Contracts\CustomerContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
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
        return $this->all($columns, $order, $sort);
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

    /**
     * @param array $params
     * @return Customer|mixed
     */
    public function createCustomer(array $params)
    {
        try {
            $collection = collect($params);

            $customer = new Customer($collection->all());

            $customer->save();

            return $customer;

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
}
