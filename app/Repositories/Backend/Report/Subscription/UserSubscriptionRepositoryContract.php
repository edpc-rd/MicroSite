<?php

namespace App\Repositories\Backend\Report\Subscription;

/**
 * Interface PermissionDependencyRepositoryContract
 * @package App\Repositories\Backend\Permission\Dependency
 */
interface UserSubscriptionRepositoryContract
{
    /**
     * @param  $id
     * @param  bool $withUsers
     * @return mixed
     */
    public function findOrThrowException($id, $withUsers = false);

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getSubscriptionsPaginated($per_page, $order_by = 'report_id', $sort = 'asc');

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getAllSubscriptions($order_by = 'report_id', $sort = 'asc', $withUser = true);

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
