<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Backend\Access\User\Subscription\DeleteSubscriptionRequest;
use App\Http\Requests\Backend\Access\User\Subscription\EditSubscriptionRequest;
use App\Http\Requests\Backend\Access\User\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Backend\Access\User\Subscription\UpdateSubscriptionRequest;
use App\Http\Requests\Backend\Access\User\Subscription\MarkSubscriptionRequest;
use App\Repositories\Backend\User\Subscription\UserSubscriptionRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\User\UserContract;

/**
 * Class ReportController
 */
class SubscriptionController extends Controller
{

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var UserSubscriptionRepositoryContract
     */
    protected $subscriptions;

    /**
     * @var ReportRepositoryContract
     */
    protected $reports;

    /**
     * @param UserSubscriptionRepositoryContract $subscriptions
     * @param UserContract $users
     * @param ReportRepositoryContract $reports
     */
    public function __construct(
        UserSubscriptionRepositoryContract $subscriptions,
        UserContract $users,
        ReportRepositoryContract $reports

    )
    {
        $this->subscriptions = $subscriptions;
        $this->users = $users;
        $this->reports = $reports;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * @param  CreateSubscriptionRequest $request
     * @return mixed
     */
    public function create(CreateSubscriptionRequest $request)
    {
        //
    }

    /**
     * @param  integer $reportId
     * @param  integer $userId
     * @param  StoreSubscriptionRequest $request
     * @return mixed
     */
    public function store($reportId,$userId,StoreSubscriptionRequest $request)
    {
        $this->subscriptions->create($reportId,$userId);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.subscriptions.activated'));
    }

    /**
     * @param  $id
     * @param  $status
     * @param  MarkSubscriptionRequest $request
     * @return mixed
     */
    public function mark($id, $status, MarkSubscriptionRequest $request)
    {
        $this->subscriptions->mark($id, $status);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.subscriptions.updated'));
    }

    /**
     * @param  $id
     * @param  EditSubscriptionRequest $request
     * @return mixed
     */
    public function edit($id, EditSubscriptionRequest $request)
    {
        //
    }

    /**
     * @param  $id
     * @param  UpdateSubscriptionRequest $request
     * @return mixed
     */
    public function update($id, UpdateSubscriptionRequest $request)
    {
        //
    }

    /**
     * @param  $id
     * @param  DeleteSubscriptionRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteSubscriptionRequest $request)
    {
        $this->subscriptions->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.subscriptions.deactivated'));
    }

}