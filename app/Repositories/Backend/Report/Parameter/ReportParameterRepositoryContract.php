<?php

namespace App\Repositories\Backend\Report\Parameter;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface ReportParameterRepositoryContract
{
    /**
     * @param  $id
     * @param  bool $withReport
     * @return mixed
     */
    public function findOrThrowException($id, $withReport = false);

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getParametersPaginated($per_page, $order_by = 'parameter_id', $sort = 'asc');

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withReport
     * @return mixed
     */
    public function getAllParameters($order_by = 'parameter_id', $sort = 'asc', $withReport = false);

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
