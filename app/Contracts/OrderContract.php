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
     * @param array $params
     * @return mixed
     */
    public function listOrder( array $params, string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrderById(int $id);

}
