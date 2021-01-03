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
     * @param array $params
     * @param string $image
     * @return mixed
     */
    public function updateExtra(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteExtra($id, array $params);

}
