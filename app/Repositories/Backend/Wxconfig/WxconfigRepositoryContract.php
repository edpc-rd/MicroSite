<?php

namespace App\Repositories\Backend\Wxconfig;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface WxconfigRepositoryContract
{
    /**
     * @param  $id
     * @param  bool $withParameters
     * @return mixed
     */
    public function findOrThrowException($id, $withParameters = false);

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getWxconfigsPaginated($per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllWxconfigs($order_by = 'id', $sort = 'asc');

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input);

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);


}
