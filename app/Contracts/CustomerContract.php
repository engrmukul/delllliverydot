<?php

namespace App\Contracts;

/**
 * Interface CustomerContract
 * @package App\Contracts
 */
interface CustomerContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCustomer(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCustomerById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCustomer(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCustomer(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCustomer($id, array $params);

}
