<?php

namespace App\Contracts;

/**
 * Interface OrderContract
 * @package App\Contracts
 */
interface OrderContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listOrder(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrderById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createOrder(array $params);

    /**
     * @param array $params
     * @param string $image
     * @return mixed
     */
    public function updateOrder(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteOrder($id, array $params);

}
