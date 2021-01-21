<?php

namespace App\Contracts;

/**
 * Interface CouponContract
 * @package App\Contracts
 */
interface HelpAndSupportContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listHelpAndSupport(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findHelpAndSupportById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createHelpAndSupport(array $params);

    /**
     * @param array $params
     * @param string $image
     * @return mixed
     */
    public function updateHelpAndSupport(array $params);

    /**
     * @param $id
     * @return bool
     */

}
