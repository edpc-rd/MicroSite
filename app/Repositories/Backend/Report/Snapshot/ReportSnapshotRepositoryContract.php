<?php

namespace App\Repositories\Backend\Report\Snapshot;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface ReportSnapshotRepositoryContract
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
    public function getSnapshotsPaginated($per_page, $order_by = 'snapshot_id', $sort = 'asc');

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withReport
     * @return mixed
     */
    public function getAllSnapshots($order_by = 'snapshot_id', $sort = 'asc', $withReport = false);

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
