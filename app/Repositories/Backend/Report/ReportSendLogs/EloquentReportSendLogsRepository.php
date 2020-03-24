<?php

namespace App\Repositories\Backend\Report\ReportSendLogs;

use App\Api\V1\Controllers\Weixin\WeixinController;
use App\Exceptions\GeneralException;
use App\Models\Report\ReportSendLogs;
use App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract;
use App\Repositories\Backend\Report\Parameter\ReportParameterRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract;
use App\Repositories\Backend\User\Subscription\UserSubscriptionRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\Wxconfig\WxconfigRepositoryContract;
use Stoneworld\Wechat\Utils\Http;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentReportSendLogsRepository implements ReportSendLogsRepositoryContract
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
     * @param ReportParameterRepositoryContract $parameters
     * @param UserSubscriptionRepositoryContract $subscriptions
     * @param ReportSnapshotRepositoryContract $snapshots
     * @param ReportRepositoryContract $reports
     * @param WxconfigRepositoryContract $wxconfigs
     */
    public function __construct(
        UserContract $users,
        ReportGroupRepositoryContract $groups,
        ReportParameterRepositoryContract $parameters,
        UserSubscriptionRepositoryContract $subscriptions,
        ReportSnapshotRepositoryContract $snapshots,
        ReportRepositoryContract $reports,
        WxconfigRepositoryContract $wxconfigs
    )
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->parameters = $parameters;
        $this->subscriptions = $subscriptions;
        $this->snapshots = $snapshots;
        $this->reports = $reports;
        $this->wxconfigs = $wxconfigs;
    }
    /**
     * @param  $per_page
     * @param  mixed $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getReportsPaginated($per_page, $order_by = 'id', $sort = 'desc')
    {
        return ReportSendLogs::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllLogs($order_by = 'id', $sort = 'desc', $withParameters = false)
    {
        if ($withParameters) {
            return ReportSendLogs::orderBy($order_by, $sort)
                ->get();
        }

        return ReportSendLogs::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  integer $status
     * @param  string $sort
     * @return mixed
     */
    public function getLogsByStatus($per_page, $status = 1, $order_by = 'id', $sort = 'desc')
    {
        return ReportSendLogs::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        return true;
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        return true;
    }

    /**
     * @param  $id
     * @param  bool $withParameters
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withParameters = false)
    {
        if (!is_null(ReportSendLogs::find($id))) {
            if ($withParameters) {
                return ReportSendLogs::find($id);
            }

            return ReportSendLogs::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.report.report.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        return true;
    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status)
    {
        $http = new Http();

//        $url = $_SERVER['HTTP_HOST'].'/api/auth/login?email=HuangPeiQi@glorisun.com&password=88888888';
//        $res = $http->get($url);
//        $res = json_decode($res['data']);

        $token = config('api.apitoken');    //以上注釋部分爲token 獲取。   此token爲v1 api接口的token
        $url = $_SERVER['HTTP_HOST'].'/api/weixin/SendReportAgain?token='.$token;
        $params = array('id' => $id);
        $rsp = $http->post($url,$params);
        $rsp = json_decode($rsp['data'],true);

        $logs = $this->findOrThrowException($id);
        $logs->status = $status;
        if ($rsp['status_code'] == 0 && $logs->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.report.send_error'));
    }

}
