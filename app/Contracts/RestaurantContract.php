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
     * @param int $featureSection
     * @return mixed
     */
    public function listRestaurant(string $order = 'id', string $sort = 'desc', array $columns = ['*'], int $featureSection = 1);

    /**
     * @param int $id
     * @return mixed
     */
    public function findRestaurantById(int $id);

}
