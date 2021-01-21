<?php

namespace App\Contracts;

/**
 * Interface CouponContract
 * @package App\Contracts
 */
interface TermsAndConditionContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTermsAndCondition(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTermsAndConditionById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTermsAndCondition(array $params);

    /**
     * @param array $params
     * @param string $image
     * @return mixed
     */
    public function updateTermsAndCondition(array $params);
}
