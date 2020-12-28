<?php

namespace App\Contracts;

/**
 * Interface FoodContract
 * @package App\Contracts
 */
interface FoodContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFood(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findFoodById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createFood(array $params);

    /**
     * @param array $params
     * @param string $image
     * @return mixed
     */
    public function updateFood(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFood($id, array $params);

}
