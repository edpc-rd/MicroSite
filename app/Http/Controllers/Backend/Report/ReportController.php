<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Report\CreateReportRequest;
use App\Http\Requests\Backend\Report\DeleteReportRequest;
use App\Http\Requests\Backend\Report\EditReportRequest;
use App\Http\Requests\Backend\Report\SendExcelRequest;
use App\Http\Requests\Backend\Report\StoreReportRequest;
use App\Http\Requests\Backend\Report\UpdateReportRequest;
use App\Http\Requests\Backend\Report\MarkReportRequest;
use App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\Wxconfig\WxconfigRepositoryContract;
use Stoneworld\Wechat\Exception;
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
     * @var WxconfigRepositoryContract
     */
    protected $wxconfigs;

    /**
     * @param UserContract $users
     * @param ReportGroupRepositoryContract $groups
     * @param ReportRepositoryContract $reports
     */
    public function __construct(
        UserContract $users,
        ReportGroupRepositoryContract $groups,
        ReportRepositoryContract $reports,
        ReportSnapshotRepositoryContract $snapshots,
        WxconfigRepositoryContract $wxconfigs

    )
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->reports = $reports;
        $this->snapshots = $snapshots;
        $this->wxconfigs = $wxconfigs;
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
            ->withWxConfig($this->wxconfigs->getAllWxconfigs())
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
            ->withWxConfig($this->wxconfigs->getAllWxconfigs())
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
    public function viewHtmlReport($fileName,SendExcelRequest $request)
    {
        View::addExtension('html', 'php');
        $this->reports->saveReportLog($request->get('reportId'),'read','');
        return view($fileName);
    }

    public  function viewImageReport($fileName,SendExcelRequest $request)
    {
        View::addExtension('jpeg','php');
        $this->reports->saveReportLog($request->get('reportId'),'read','');
        return view($fileName);
    }

    //add by 2020-03-11 Hpq 發送文件消息
    public  function viewExcelReport($fileName,SendExcelRequest $request)
    {
        set_time_limit(180);
        ini_set("max_input_time", 180);

        $member = app('weixin')->getMemberInfo();
        try{
            $wxconfig = $this->wxconfigs->findOrThrowException(intval($request->get('id')));
            app('weixin')->setWxconfig($wxconfig->id);
        }catch(\Exception $e){
            throw new Exception('發送報表失敗，企业微信配置不存在',30050);
        }
        try {
            $report = $this->reports->findOrThrowException($request->get('reportId'));
        } catch (\Exception $e) {
            throw new Exception('發送報表失敗，報表或用戶ID錯誤',30004);
        }
        try{
            $xlsSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'EXCEL');
        }catch(\Exception $e){
            throw new Exception('發送報表失敗，獲取報表快照錯誤',30007);
        }

        try{
            $excelPath = $xlsSnapshot->file_path . DIRECTORY_SEPARATOR . $xlsSnapshot->file_name;
            file_put_contents('/web/website/laravel/MicroSite/serve987.txt',$excelPath."\n",FILE_APPEND);
            $media_id = app('weixin')->uploadFile($excelPath);
        }catch(\Exception $e){
            throw new Exception('上傳報表失敗！',30007);
        }
        try{
            app('weixin')->sendFileToUser($media_id, array($member['UserId']));
        }catch(\Exception $e){
            throw new Exception('報表发送失敗！',30007);
        }
        $this->reports->saveReportLog($report->report_id,'excel',$member['UserId']);
        echo "<h1>已向您發送Excel格式的報表！</h1>";
    }
}