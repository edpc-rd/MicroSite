<?php

namespace App\Repositories\Backend\Report\ReportReadLogs;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface ReportReadLogsRepositoryContract
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
    public function getReportsPaginated($per_page, $order_by = 'id', $sort = 'asc',$start = '',$end = '');

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  integer $status
     * @param  string $sort
     * @return mixed
     */
    public function getLogsByStatus($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllLogs($order_by = 'id', $sort = 'asc', $withParameters = false);

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
