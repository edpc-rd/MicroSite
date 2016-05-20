<?php

namespace App\Repositories\Backend\Report\Subscription;

use App\Exceptions\GeneralException;
use App\Models\Report\UserSubscription;
/**
 * Class EloquentUserSubscriptionRepository
 * @packageApp\Repositories\Backend\Report\Subscription
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
        return UserSubscription::with('user','report')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withUser
     * @return mixed
     */
    public function getAllSubscriptions($order_by = 'sort_order', $sort = 'asc', $withUser = true)
    {
        if ($withUser) {
            return UserSubscription::with('user','report')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return UserSubscription::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        $subscription = new UserSubscription;
        $subscription->user_id = isset($input['user_id']) && strlen($input['user_id']) > 0 ? (int)$input['user_id'] : null;
        $subscription->report_id = isset($input['report_id']) && strlen($input['report_id']) > 0 ? (int)$input['report_id'] : null;
        $subscription->subscribe_status =  0;
        $subscription->subscribe_time =DB::raw('CURRENT_TIMESTAMP');
        $subscription->receive_mode = $input['receive_mode'];


        if ($subscription->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.report.report.create_error'));
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
        $subscription->subscribe_time =DB::raw('CURRENT_TIMESTAMP');
        $subscription->receive_mode = $input['receive_mode'];

        if ($subscription->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.report.update_error'));
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
                return UserSubscription::with('user','report')
                    ->find($id);
            }

            return UserSubscription::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.report.subscription.not_found'));
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
            throw new GeneralException(trans('exceptions.backend.report.subscription.cant_delete_active'));
        }

        if ($subscription->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.subscription.delete_error'));
    }
}