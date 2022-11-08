<?php

namespace App\Http\Controllers\Backend\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Report\Logs\MarkReportReadLogsRequest;
use App\Repositories\Backend\Report\ReportReadLogs\ReportReadLogsRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use View;

/**
 * Class ReportReadLogsController
 */
class ReportReadLogsController extends Controller
{

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var ReportReadLogsParameterRepositoryContract
     */
    protected $parameters;

    /**
     * @var ReportReadLogsRepositoryContract
     */
    protected $readlogs;

    /**
     * @param UserContract $users
     * @param ReportReadLogsRepositoryContract $readlogs
     */
    public function __construct(
        UserContract $users,
        ReportReadLogsRepositoryContract $readlogs
    )
    {
        $this->users = $users;
        $this->readlogs = $readlogs;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        if($request->get('explode',0) == 1){
            $this->readlogs->explodeExcel($start,$end);
            return;
        }

        if(strtotime($start.' 00:00:00') > strtotime($end. ' 23:59:59'))
        {
            return redirect()->back()->withErrors('结束时间不能小于开始时间！');
        }

        $url = route('admin.logs.report-read-logs.index',['start'=> $start,'end'=>$end]);


//        var_dump(strtotime ($start.' 00:00:00'));
//        var_dump(strtotime($end. ' 23:59:59'));die;

        return view('backend.report.readlogs.index')
            ->withReads($this->readlogs->getReportsPaginated(50,'id','desc',$start,$end));
    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
//        return view('backend.report.readlogs.create');
    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
//        $this->readlogs->create($request->all());
//        return redirect()->route('admin.wxconfig.readlogs.index')->
//        withFlashSuccess(trans('alerts.backend.readlogs.created'));
    }

    /**
     * @param  $id
     * @param  Request $request
     * @return mixed
     */
    public function edit($id, Request $request)
    {
//        $readlogs = $this->readlogs->findOrThrowException($id, true);
//        return view('backend.report.readlogs.edit')
//            ->withReportReadLogs($readlogs);
    }

    /**
     * @param  $id
     * @param  Request $request
     * @return mixed
     */
    public function check($id, Request $request)
    {
//        if($this->readlogs->check($id))
//            return redirect()->back()->withFlashSuccess(trans('alerts.backend.readlogs.succ'));
//        return redirect()->back()->withFlashDanger(trans('alerts.backend.readlogs.fail'));
    }

    /**
     * @param  $id
     * @param  Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
//        $this->readlogs->update($id, $request->all());
//        return redirect()->back()->withFlashSuccess(trans('alerts.backend.readlogs.updated'));
    }

    /**
     * @param  $id
     * @param  Request $request
     * @return mixed
     */
    public function destroy($id, Request $request)
    {
//        $this->readlogs->destroy($id);
//        return redirect()->back()->withFlashSuccess(trans('alerts.backend.readlogs.deleted_permanently'));
    }

}