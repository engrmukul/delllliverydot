<?php

namespace App\Contracts;

/**
 * Interface SettingsContract
 * @package App\Contracts
 */
interface SettingsContract
{
    /**
     * @param array $params
     * @param string $image
     * @return mixed
     */
    public function updateSettings(array $params);

}
