<?php

namespace App\Contracts;

/**
 * Interface ExtraContract
 * @package App\Contracts
 */
interface ExtraContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function requestedExtra(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function allExtras(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $extraId
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listExtra(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findExtraById(int $id);


    /**
     * @param array $params
     * @return mixed
     */
    public function createExtra(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteExtra($id, array $params);

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
