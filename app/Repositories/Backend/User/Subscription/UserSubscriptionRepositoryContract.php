<?php

namespace App\Repositories\Backend\User\Subscription;

/**
 * Interface UserSubscriptionRepositoryContract
 * @package App\Repositories\Backend\User\Subscription
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
     * @param  $userId
     * @param  $reportId
     * @param  bool $withUser
     * @return mixed
     */
    public function findByUserAndReport($userId, $reportId, $withUser = false);

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getSubscriptionsPaginated($per_page, $order_by = 'user_id', $sort = 'asc');

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getAllSubscriptions($order_by = 'user_id', $sort = 'asc', $withUser = true);

    /**
     * @param  integer $report_id
     * @param  integer $status
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getSubscriptionsByReportId($report_id, $status = 1, $order_by = 'report_id', $sort = 'asc', $withUser = true);

    /**
     * @param  integer $user_id
     * @param  integer $status
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getSubscriptionsByUserId($user_id, $status = 1, $order_by = 'user_id', $sort = 'asc', $withUser = true);

    /**
     * @param  $reportId
     * @param  $userId
     * @return mixed
     */
    public function create($reportId, $userId);

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

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status);
}
