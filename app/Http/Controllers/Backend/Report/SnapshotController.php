<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Report\CreateReportRequest;
use App\Http\Requests\Backend\Report\DeleteReportRequest;
use App\Http\Requests\Backend\Report\EditReportRequest;
use App\Http\Requests\Backend\Report\StoreReportRequest;
use App\Http\Requests\Backend\Report\UpdateReportRequest;
use App\Repositories\Backend\User\Subscription\UserSubscriptionRepositoryContract;
use App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract;
use App\Repositories\Backend\Report\Parameter\ReportParameterRepositoryContract;
use App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use View;

/**
 * Class ReportController
 */
class SnapshotController extends Controller
{

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var ReportGroupRepositoryContract
     */
    protected $groups;

    /**
     * @var ReportParameterRepositoryContract
     */
    protected $parameters;

    /**
     * @var UserSubscriptionRepositoryContract
     */
    protected $subscriptions;

    /**
     * @var ReportSnapshotRepositoryContract
     */
    protected $snapshots;

    /**
     * @var ReportRepositoryContract
     */
    protected $reports;

    /**
     * @param UserContract $users
     * @param ReportGroupRepositoryContract $groups
     * @param ReportParameterRepositoryContract $parameters
     * @param UserSubscriptionRepositoryContract $subscriptions
     * @param ReportSnapshotRepositoryContract $snapshots
     * @param ReportRepositoryContract $reports
     */
    public function __construct(
        UserContract $users,
        ReportGroupRepositoryContract $groups,
        ReportParameterRepositoryContract $parameters,
        UserSubscriptionRepositoryContract $subscriptions,
        ReportSnapshotRepositoryContract $snapshots,
        ReportRepositoryContract $reports

    )
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->parameters = $parameters;
        $this->subscriptions = $subscriptions;
        $this->snapshots = $snapshots;
        $this->reports = $reports;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.access.index')
            ->withUsers($this->users->getUsersPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateReportRequest $request
     * @return mixed
     */
    public function create(CreateReportRequest $request)
    {
        return view('backend.access.create')
            ->withRoles($this->roles->getAllRoles('sort_order', 'asc', true))
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * @param  StoreReportRequest $request
     * @return mixed
     */
    public function store(StoreReportRequest $request)
    {
        $this->users->create(
            $request->except('assignees_roles', 'permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
        );
        return redirect()->route('admin.access.users.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param  $id
     * @param  EditReportRequest $request
     * @return mixed
     */
    public function edit($id, EditReportRequest $request)
    {
        $user = $this->users->findOrThrowException($id, true);
        return view('backend.access.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->lists('role_id')->all())
            ->withRoles($this->roles->getAllRoles('sort_order', 'asc', true))
            ->withUserPermissions($user->permissions->lists('permission_id')->all())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * @param  $id
     * @param  UpdateReportRequest $request
     * @return mixed
     */
    public function update($id, UpdateReportRequest $request)
    {
        $this->users->update($id,
            $request->except('assignees_roles', 'permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
        );
        return redirect()->route('admin.access.users.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteReportRequest $request
     * @return mixed
     */
    public function delete($id, DeleteReportRequest $request)
    {
        $this->users->delete($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param string $fileName
     * @return mixed
     */
    public function viewHtmlReport($fileName)
    {
        View::addExtension('html','php');
        return view($fileName);
    }
}