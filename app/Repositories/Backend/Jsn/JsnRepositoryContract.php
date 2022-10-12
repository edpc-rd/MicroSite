<?php

namespace App\Repositories\Backend\Jsn;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface JsnRepositoryContract
{
    /**
     * @param  $input
     * @return mixed
     */
    public function create($input);
}
