<?php

namespace App\Contracts;

/**
 * Interface RestaurantContract
 * @package App\Contracts
 */
interface RestaurantContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function requestedRestaurant(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function allRestaurants(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $restaurantId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRestaurant(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findRestaurantById(int $id);


    /**
     * @param array $params
     * @return mixed
     */
    public function createRestaurant(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteRestaurant($id, array $params);

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



