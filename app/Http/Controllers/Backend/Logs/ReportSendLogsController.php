<?php

namespace App\Http\Controllers\Backend\Logs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Report\Logs\MarkReportSendLogsRequest;
use App\Repositories\Backend\Report\ReportSendLogs\ReportSendLogsRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use View;

/**
 * Class ReportSendLogsController
 */
class ReportSendLogsController extends Controller
{

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var ReportSendLogsParameterRepositoryContract
     */
    protected $parameters;

    /**
     * @var ReportSendLogsRepositoryContract
     */
    protected $sendlogs;

    /**
     * @param UserContract $users
     * @param ReportSendLogsRepositoryContract $sendlogs
     */
    public function __construct(
        UserContract $users,
        ReportSendLogsRepositoryContract $sendlogs
    )
    {
        $this->users = $users;
        $this->sendlogs = $sendlogs;
    }

    /**
     * @return mixed
     */
    public function index()
    {
//        var_dump($this->sendlogs->getReportsPaginated(50));die;
        return view('backend.report.sendlogs.index')
            ->withLogs($this->sendlogs->getReportsPaginated(50));
    }

    /**
     * @param  CreateReportSendLogsRequest $request
     * @return mixed
     */
    public function create(CreateReportSendLogsRequest $request)
    {
//        return view('backend.report.sendlogs.create');
    }

    /**
     * @param  StoreReportSendLogsRequest $request
     * @return mixed
     */
    public function store(StoreReportSendLogsRequest $request)
    {
//        $this->sendlogs->create($request->all());
//        return redirect()->route('admin.wxconfig.sendlogs.index')->
//        withFlashSuccess(trans('alerts.backend.sendlogs.created'));
    }

    /**
     * @param  $id
     * @param  EditReportSendLogsRequest $request
     * @return mixed
     */
    public function edit($id, EditReportSendLogsRequest $request)
    {
//        $sendlogs = $this->sendlogs->findOrThrowException($id, true);
//        return view('backend.report.sendlogs.edit')
//            ->withReportSendLogs($sendlogs);
    }

    /**
     * @param  $id
     * @param  EditReportSendLogsRequest $request
     * @return mixed
     */
    public function check($id, MarkReportSendLogsRequest $request)
    {
//        if($this->sendlogs->check($id))
//            return redirect()->back()->withFlashSuccess(trans('alerts.backend.sendlogs.succ'));
//        return redirect()->back()->withFlashDanger(trans('alerts.backend.sendlogs.fail'));
    }

    /**
     * @param  $id
     * @param  UpdateReportSendLogsRequest $request
     * @return mixed
     */
    public function update($id, UpdateReportSendLogsRequest $request)
    {
//        $this->sendlogs->update($id, $request->all());
//        return redirect()->back()->withFlashSuccess(trans('alerts.backend.sendlogs.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteReportSendLogsRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteReportSendLogsRequest $request)
    {
//        $this->sendlogs->destroy($id);
//        return redirect()->back()->withFlashSuccess(trans('alerts.backend.sendlogs.deleted_permanently'));
    }

    /**
     * @param  $id
     * @param  $status
     * @param  MarkReportRequest $request
     * @return mixed
     */
    public function mark($id, $status, MarkReportSendLogsRequest $request)
    {
        $this->sendlogs->mark($id, $status);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.reports.send'));
    }
}