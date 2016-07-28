<?php

namespace App\Repositories\Backend\User\Subscription;

use App\Exceptions\GeneralException;
use App\Models\Access\User\UserSubscription;
use Carbon\Carbon;
/**
 * Class EloquentUserSubscriptionRepository
 * @package App\Models\Access\User\UserSubscription
 */
class EloquentUserSubscriptionRepository implements UserSubscriptionRepositoryContract
{
    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getSubscriptionsPaginated($per_page, $order_by = 'sort_order', $sort = 'asc')
    {
        return UserSubscription::with('user', 'report')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getAllSubscriptions($order_by = 'user_id', $sort = 'asc', $withUser = false)
    {
        if ($withUser) {
            return UserSubscription::with('user', 'report')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return UserSubscription::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  integer $report_id
     * @param  integer $status
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getSubscriptionsByReportId($report_id, $status = 1, $order_by = 'report_id', $sort = 'asc', $withUser = true)
    {
        if ($withUser) {
            return UserSubscription::with('user', 'report')->where(['report_id' => $report_id, 'subscribe_status' => $status])
                ->orderBy($order_by, $sort)
                ->get();
        }

        return UserSubscription::where(['report_id' => $report_id, 'subscribe_status' => $status])->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  integer $user_id
     * @param  integer $status
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getSubscriptionsByUserId($user_id, $status = 1, $order_by = 'user_id', $sort = 'asc', $withUser = false)
    {
        if ($withUser) {
            return UserSubscription::with('user', 'report')->where(['user_id' => $user_id, 'subscribe_status' => $status])
                ->orderBy($order_by, $sort)
                ->get();
        }

        return UserSubscription::where(['user_id' => $user_id])->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $reportId
     * @param  $userId
     * @throws GeneralException
     * @return bool
     */
    public function create($reportId,$userId)
    {
        $subscription = new UserSubscription;
        $subscription->user_id = isset($userId) && strlen($userId) > 0 ? (int)$userId : null;
        $subscription->report_id = isset($reportId) && strlen($reportId) > 0 ? (int)$reportId : null;
        $subscription->subscribe_status = 0;

        if ($subscription->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.report.subscriptions.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $subscription = $this->findOrThrowException($id);

        $subscription->user_id = isset($input['user_id']) && strlen($input['user_id']) > 0 ? (int)$input['user_id'] : null;
        $subscription->report_id = isset($input['report_id']) && strlen($input['report_id']) > 0 ? (int)$input['report_id'] : null;
        $subscription->subscribe_time = DB::raw('CURRENT_TIMESTAMP');
        $subscription->receive_mode = $input['receive_mode'];

        if ($subscription->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.subscriptions.update_error'));
    }

    /**
     * @param  $id
     * @param  bool $withUser
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withUser = true)
    {
        if (!is_null(UserSubscription::find($id))) {
            if ($withUser) {
                return UserSubscription::with('user', 'report')
                    ->find($id);
            }

            return UserSubscription::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.report.subscriptions.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {

        $subscription = $this->findOrThrowException($id);

        //Don't delete the role is there are users associated
        if ($subscription->subscribe_status == 1) {
            throw new GeneralException(trans('exceptions.backend.report.subscriptions.cant_delete_active'));
        }

        if ($subscription->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.subscriptions.delete_error'));
    }

    /**
     * @param  $userId
     * @param  $reportId
     * @param  bool $withUser
     * @return mixed
     */
    public function findByUserAndReport($userId, $reportId, $withUser = false)
    {
        if ($withUser) {
            return UserSubscription::with('user', 'report')->where(['user_id' => $userId, 'report_id' => $reportId])->first();
        }
        return UserSubscription::where(['user_id' => $userId, 'report_id' => $reportId])->first();

    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status)
    {

        $subscription = $this->findOrThrowException($id);
        $subscription->subscribe_status = $status;
        $subscription->subscribe_time = Carbon::now();

        if ($subscription->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.subscriptions.mark'));
    }

    /**
     * @param integer $reportId
     * @param integer $userId
     * @return string
     */
    public function getActionButtons($reportId, $userId)
    {
        if (access()->allow('store-report-subscriptions')) {
            return '<a href="' . route('admin.access.user.subscription.store', [$reportId, $userId]) . '"
                 data-method="post"
                 data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . trans('buttons.backend.access.subscriptions.activate') . '"
                 data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
                 class="btn btn-xs btn-primary"><i class="fa fa-unlock" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.backend.access.subscriptions.activate') . '"></i></a>';
        }

        return '';
    }
}