<?php

namespace App\Api\V1\Controllers\Weixin;

use App\Api\V1\Controllers\BaseController;
use App\Api\V1\Requests\Weixin\SendReportAgainRequest;
use App\Api\V1\Requests\Weixin\ServeRequest;
use App\Models\Access\User\User;
use App\Models\Report\ReportSendLogs;
use App\Models\Wxconfig\Wxconfig;
use App\Repositories\Backend\Report\ReportSendLogs\ReportSendLogsRepositoryContract;
use App\Repositories\Backend\Wxconfig\WxconfigRepositoryContract;
use Stoneworld\Wechat\Message;
use Stoneworld\Wechat\Messages\NewsItem;
use Stoneworld\Wechat\Messages\MpNewsItem;
use App\Api\V1\Requests\Weixin\SendMsgRequest;
use App\Api\V1\Requests\Weixin\SendImgRequest;
use App\Api\V1\Requests\Weixin\GetFileRequest;
use App\Api\V1\Requests\Weixin\GetForeverFileRequest;
use App\Api\V1\Requests\Weixin\ForeverFileListRequest;
use App\Api\V1\Requests\Weixin\UploadFileRequest;
use App\Api\V1\Requests\Weixin\UploadImageRequest;
use App\Api\V1\Requests\Weixin\SendNewsRequest;
use App\Api\V1\Requests\Weixin\SendMpNewsRequest;
use App\Api\V1\Requests\Weixin\SendMpNewsByIdRequest;
use App\Repositories\Backend\User\Subscription\UserSubscriptionRepositoryContract;
use App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract;
use App\Repositories\Backend\Report\Parameter\ReportParameterRepositoryContract;
use App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use Stoneworld\Wechat\Exception;
/**
 * Class WeixinController
 * @package App\Api\V1\Controllers\Weixin
 */
class WeixinController extends BaseController
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
     * @var ReportSendLogsRepositoryContract
     */
    protected $logs;

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
        WxconfigRepositoryContract $wxconfigs,
        ReportSendLogsRepositoryContract $logs
    )
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->parameters = $parameters;
        $this->subscriptions = $subscriptions;
        $this->snapshots = $snapshots;
        $this->reports = $reports;
        $this->wxconfigs = $wxconfigs;
        $this->logs = $logs;
    }


    public function serve(ServeRequest $request)
    {
        $id = ($request->get('id'))?intval($request->get('id')):0;
        $server = app('weixin')->server($id);
//        file_put_contents('/web/website/laravel/MicroSiteTest/serve.txt',$id."\n",FILE_APPEND);
        // 您可以直接echo 或者返回给框架
        die($server->serve());

        /*$server->on('message', function($message) {
            return Message::make('text')->content('您好！' . $message->FromUserName . ':' . $message->Content );
        });

        $server->on('event', 'subscribe', function ($event) {

            error_log('收到关注事件，关注者openid: ' . $event['FromUserName']);

            return Message::make('text')->content('感谢您关注');
        });

        $result = $server->serve();

        echo $result; */
    }

    public function sendMsgToTag(SendMsgRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));
        return app('weixin')->sendMsgToTag($request->get('content'), $request->get('tagId'));
    }

    public function sendMsgToUser(SendMsgRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));
        return app('weixin')->sendMsgToUser($request->get('content'), $request->get('users'));
    }

    public function sendImgToUser(SendImgRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));
        return app('weixin')->sendImgToUser($request->get('media_id'), $request->get('users'));
    }

    public function getMemberInfo()
    {
        return app('weixin')->getMemberInfo();
    }

    public function getFile(GetFileRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'downloads'.DIRECTORY_SEPARATOR . $request->get('fileName');
        return app('weixin')->getFile($request->get('media_id'), $filePath);
    }

    public function getForeverFile(GetForeverFileRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'downloads'.DIRECTORY_SEPARATOR . $request->get('fileName');
        return app('weixin')->getForeverFile($request->get('media_id'), $filePath);
    }

    public function getForeverFileList(ForeverFileListRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));
        return app('weixin')->getForeverFileList($request->get('type'));
    }

    public function uploadFile(UploadFileRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'excel'.DIRECTORY_SEPARATOR . $request->get('fileName');
        return app('weixin')->uploadFile($filePath);
    }

    public function uploadImage(UploadImageRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR . $request->get('fileName');
        return app('weixin')->uploadImage($filePath);
    }

    public function uploadNewsImg(UploadImageRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR . $request->get('fileName');
        return app('weixin')->uploadNewsImg($filePath);
    }

    public function uploadForeverMedia(UploadFileRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'excel'.DIRECTORY_SEPARATOR . $request->get('fileName');
        return app('weixin')->uploadForeverMedia($filePath);
    }

    public function sendNews(SendNewsRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR . $request->get('fileName');
        $picUrl = app('weixin')->uploadNewsImg($filePath);
        $users = $request->get('users');
        $newsItem = new NewsItem();
        $newsItem->title = $request->get('title');
        $newsItem->description = $request->get('description');
        $newsItem->pic_url = $picUrl;
        $newsItem->url = $request->get('url');
        return app('weixin')->sendNews($newsItem, $users);
    }

    public function sendMpNews(SendMpNewsRequest $request)
    {
        //企业微信id BY HPQ 2020-03-03
        $this->setWeixin(intval($request->get('wxId')));

        $redirect_url = $request->get('url');
        $users = $request->get('users');
        $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR . $request->get('fileName');
        $media_id = app('weixin')->uploadImage($filePath);
        $newsItem = new MpNewsItem();
        $newsItem->title = $request->get('title');
        $newsItem->thumb_media_id = $media_id['media_id'];
        $newsItem->author = $request->get('author');
        $newsItem->content = $request->get('content');
        $newsItem->digest = $request->get('digest');
        $newsItem->show_cover_pic = $request->get('show_cover_pic');
        return app('weixin')->sendMpNews($newsItem, $redirect_url, $users);
    }

    public function sendReportById(SendMpNewsByIdRequest $request)
    {
        try {
            $report = $this->reports->findOrThrowException($request->get('reportId'));
            if ($request->get('toAll') == 0) {
                $users = $report->users()->get();
                foreach ($users as $user) {
                    $arrUsers[]['UserName'] = $user->user_name;
                    $arrUsers[]['Email'] = $user->email;
                }
                $userNames = array_column($arrUsers, 'UserName');
                /*$userEmails = array_column($arrUsers, 'Email');*/
            } else {
                $userNames = '@all';
            }
        } catch (\Exception $e) {
            throw new Exception('發送報表失敗，報表或用戶ID錯誤',30004);
        }

        if ($report->receive_mode == 'email') {
            throw new Exception('發送報表失敗，暫不支持發送郵件',30005);
        }
        if ($report->status == 0) {
            throw new Exception('發送報表失敗，報表狀態為未啟用',30006);
        }

        if(intval($request->get('wxId')) > 0){    //指定發送企業微信
            $wxid = intval($request->get('wxId'));
        }else{
            //獲取需要指定的發送企業微信的用戶
            $us = User::wherein('user_name',$userNames)->where('send_wxid','!=',0)->get();
            if($us){
                foreach ($us as $u) {
                    $arrUs[$u->send_wxid][]['UserName'] = $u->user_name;
                    $arrUs[$u->send_wxid][]['Email'] = $u->email;
                    $arrUs[$u->send_wxid][]['send_wxid'] = $u->send_wxid;
                }

                //生成需要發送的信息 和 排除指定發送企業微信的用戶
                foreach ($arrUs as $k => $arrU){
                    $sendNames = array_column($arrU, 'UserName');
                    $arrSend[$k]['UserName'] = $sendNames;
                    $arrSend[$k]['send_wxid'] = $k;
                    $userNames = array_diff($userNames,$sendNames);
                }
            }

            //獲取報表指定發送的企業微信
            $wxid = 0;
            //報表指定發送的企業微信
            if($report->send_wxid)
                $wxid = $report->send_wxid;

        }

        //需要發送信息的合集
        $arrSend[] = array(
            'UserName' => $userNames,
            'send_wxid' => $wxid
        );

        $data = array(
            'message' => '',
            'code' => 0,
            'status_code' => 0,
            'send_id' => 'SN' . time()     //發送批次號
        );

        foreach ($arrSend as $arr){
            try {
                //企业微信id  BY HPQ 2020-03-03
                $wxconfig = $this->setWeixin($arr['send_wxid']);
                $msg_data = $this->SendReport($arr,$report,$wxconfig);
            }catch (\Exception $e){
                $msg_data['code'] = $e->getCode();
                $msg_data['message'] = $e->getMessage();
                $msg_data['status_code'] = 500;
            }
            if($msg_data['status_code'] == 500){
                $data['status_code'] = 500;
            }
            if($arr['send_wxid'] == 0){
                $wxconfig['name'] .='[默認]';
            }
            $data['message'] .= $wxconfig['name'] . '-' . $wxconfig['id'] . ':' . $msg_data['message'] .';';

            //發送日誌
            ReportSendLogs::create(array('report_id' => $report->report_id,'user_name' => serialize($arr['UserName']),'send_id' => $data['send_id'],'wxid' =>$arr['send_wxid'],'status' =>($msg_data['status_code']==500?-1:0),'message' => $msg_data['message'] ));
        }

        return $data;
    }

    //設置微信配置
    private function setWeixin($id){
        //企业微信id BY HPQ 2020-03-03
        try{
            $wxconfig = $this->wxconfigs->findOrThrowException($id);
            app('weixin')->setWxconfig($wxconfig->id);
        }catch(\Exception $e){
            throw new Exception('發送報表失敗，企业微信配置不存在',30050);
        }
        return $wxconfig;
    }

    public function SendReport($arr,$report,$wxconfig){
//        $report->format = 'TEXT';
//        $content = 'TEXT';
        switch (strtoupper($report->format)) {
            case 'TEXT':
                {
                    $snapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'TEXT');
                    $content = $snapshot->abstract;
                    return app('weixin')->sendMsgToUser($content, $arr['UserName']);
                };
                break;
            case 'IMAGE':
                {
                    $snapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'IMAGE');
                    $filePath = $snapshot->file_path . DIRECTORY_SEPARATOR . $snapshot->file_name;
                    $media_id = app('weixin')->uploadImage($filePath);

                    return app('weixin')->sendImgToUser($media_id['media_id'], $arr['UserName']);
                }
                break;
            case 'FILE':
                {
                    $snapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'EXCEL');
                    $filePath = $snapshot->file_path . DIRECTORY_SEPARATOR . $snapshot->file_name;
                    $media_id = app('weixin')->uploadFile($filePath);

                    return app('weixin')->sendFileToUser($media_id, $arr['UserName']);
                }
                break;
            case 'MPNEWS':
                {
                    try {
                        $imgSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'IMAGE');
                        $htmlSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'HTML');
                        $xlsSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'EXCEL');   //取消獲取EXCEL信息    2020-02-28   Hpq
                    } catch (\Exception $e) {
                        throw new Exception('發送報表失敗，獲取報表快照錯誤', 30007);
                    }

                    $xlsName = basename($htmlSnapshot->file_name, "." . substr(strrchr($htmlSnapshot->file_name, '.'), 1));
                    $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/third/report/html/' . $xlsName . '?thirdLogin=true&id=' . $wxconfig->id;
                    $download_url = 'http://' . $_SERVER['SERVER_NAME'] . '/third/report/excel/' . $xlsName . '?thirdLogin=true&id=' . $wxconfig->id . '&reportId=' . $report->report_id;
                    $imgPath = $imgSnapshot->file_path . DIRECTORY_SEPARATOR . $imgSnapshot->file_name;
                    $media_id = app('weixin')->uploadImage($imgPath);

                    $newsItem = new MpNewsItem();
                    $newsItem->title = $imgSnapshot->abstract;
                    $newsItem->thumb_media_id = $media_id['media_id'];
                    if ($xlsSnapshot) {
                        $newsItem->content = $htmlSnapshot->abstract . '<br /><a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $wxconfig->appid . '&redirect_uri=' . urlencode($download_url) . '&response_type=code&scope=snsapi_base&state=STATE&connect_redirect=1#wechat_redirect">點此獲取Excel格式報表</a>';    //重獲取EXCEL信息改爲獲取Html信息   2020-02-28   Hpq
                    } else {
                        $newsItem->content = $htmlSnapshot->abstract;
                    }
                    $newsItem->digest = $htmlSnapshot->abstract;
                    $newsItem->show_cover_pic = 1;

                    return app('weixin')->sendMpNews($newsItem, $redirect_url, $arr['UserName']);
                }
                break;
            default:
                throw new Exception('發送報表失敗，不支持的發送類型', 30008);
        }
    }

    //發送失敗重新發送
    public function SendReportAgain(SendReportAgainRequest $request)
    {
        $logs = $this->logs->findOrThrowException($request->get('id'));
        $arr['UserName'] = unserialize($logs->user_name);
        $report = $this->reports->findOrThrowException($logs->report_id);
        $wxconfig = $this->setWeixin($logs->wxid);
        return $this->SendReport($arr, $report, $wxconfig);
    }

}