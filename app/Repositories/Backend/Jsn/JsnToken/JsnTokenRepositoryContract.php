<?php

namespace App\Repositories\Backend\Jsn\JsnToken;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface JsnTokenRepositoryContract
{
    /**
     * @param  $input
     * @return mixed
     */
    public function create($input);
}
