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
    public function requestedFood(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function allFoods(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $foodId
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
     * @param $id
     * @return bool
     */
    public function deleteFood($id, array $params);

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
