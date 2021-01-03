<?php

namespace App\Contracts;

/**
 * Interface RiderContract
 * @package App\Contracts
 */
interface RiderContract
{
    /**
     * @param int $riderId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRider(int $riderId, string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findRiderById(int $id);


    /**
     * @param array $params
     * @return mixed
     */
    public function createRider(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteRider($id, array $params);

    public function updateRider(array $params);

}
