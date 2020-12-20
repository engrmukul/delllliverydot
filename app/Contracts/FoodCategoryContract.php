<?php

namespace App\Contracts;

/**
 * Interface FoodCategoryContract
 * @package App\Contracts
 */
interface FoodCategoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function requestedFoodCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function allFoodCategorys(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $foodCategoryId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFoodCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findFoodCategoryById(int $id);


    /**
     * @param array $params
     * @return mixed
     */
    public function createFoodCategory(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFoodCategory($id, array $params);

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
