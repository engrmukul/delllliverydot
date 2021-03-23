<?php

namespace App\Contracts;

/**
 * Interface PromotionalContract
 * @package App\Contracts
 */
interface PromotionalContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPromotional(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findPromotionalById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createPromotional(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePromotional(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deletePromotional($id, array $params);

}
