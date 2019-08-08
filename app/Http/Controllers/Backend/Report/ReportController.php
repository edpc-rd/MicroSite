<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Report\CreateReportRequest;
use App\Http\Requests\Backend\Report\DeleteReportRequest;
use App\Http\Requests\Backend\Report\EditReportRequest;
use App\Http\Requests\Backend\Report\StoreReportRequest;
use App\Http\Requests\Backend\Report\UpdateReportRequest;
use App\Http\Requests\Backend\Report\MarkReportRequest;
use App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use View;

/**
 * Class ReportController
 */
class ReportController extends Controller
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
     * @param ReportRepositoryContract $reports
     */
    public function __construct(
        UserContract $users,
        ReportGroupRepositoryContract $groups,
        ReportRepositoryContract $reports

    )
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->reports = $reports;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.report.reports.index')
            ->withReports($this->reports->getReportsPaginated(50));
    }

    /**
     * @param  CreateReportRequest $request
     * @return mixed
     */
    public function create(CreateReportRequest $request)
    {
        return view('backend.report.reports.create')
            ->withGroups($this->groups->getAllGroups(true));
    }

    /**
     * @param  StoreReportRequest $request
     * @return mixed
     */
    public function store(StoreReportRequest $request)
    {
        $this->reports->create($request->all());
        return redirect()->route('admin.report.reports.index')->
        withFlashSuccess(trans('alerts.backend.reports.created'));
    }

    /**
     * @param  $id
     * @param  $status
     * @param  MarkReportRequest $request
     * @return mixed
     */
    public function mark($id, $status, MarkReportRequest $request)
    {
        $this->reports->mark($id, $status);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.reports.updated'));
    }

    /**
     * @param  $id
     * @param  EditReportRequest $request
     * @return mixed
     */
    public function edit($id, EditReportRequest $request)
    {
        $report = $this->reports->findOrThrowException($id, true);
        return view('backend.report.reports.edit')
            ->withReport($report)
            ->withGroups($this->groups->getAllGroups(true));
    }

    /**
     * @param  $id
     * @param  UpdateReportRequest $request
     * @return mixed
     */
    public function update($id, UpdateReportRequest $request)
    {
        $this->reports->update($id, $request->all());
        return redirect()->route('admin.report.reports.index')->withFlashSuccess(trans('alerts.backend.reports.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteReportRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteReportRequest $request)
    {
        $this->reports->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.reports.deleted_permanently'));
    }

    /**
     * @param string $fileName
     * @return mixed
     */
    public function viewHtmlReport($fileName)
    {
        View::addExtension('html', 'php');
        return view($fileName);
    }

    public  function viewImageReport($fileName)
    {
        View::addExtension('jpeg','php');
        return view($fileName);
    }
}