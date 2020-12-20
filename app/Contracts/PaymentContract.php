<?php

namespace App\Contracts;

/**
 * Interface PaymentContract
 * @package App\Contracts
 */
interface PaymentContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function requestedPayment(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function allPayments(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $paymentId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPayment(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findPaymentById(int $id);


    /**
     * @param array $params
     * @return mixed
     */
    public function createPayment(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deletePayment($id, array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function categoryUpdate(array $params);

    /**
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function deleteCategory($id, array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function createLocation(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function locationUpdate(array $params);

    /**
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function deleteLocation($id, array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function createComplain(array $params);

}
