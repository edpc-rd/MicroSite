<?php

namespace App\Api\V1\Controllers\Weixin;

use App\Api\V1\Controllers\BaseController;
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


    public function serve()
    {
        $server = app('weixin')->server();

        // 您可以直接echo 或者返回给框架
        //die($server->serve());

        $server->on('message', function($message) {
            return Message::make('text')->content('您好！' . $message->FromUserName . ':' . $message->Content );
        });

        $server->on('event', 'subscribe', function ($event) {

            error_log('收到关注事件，关注者openid: ' . $event['FromUserName']);

            return Message::make('text')->content('感谢您关注');
        });

        $result = $server->serve();

        echo $result;
    }

    public function sendMsgToTag(SendMsgRequest $request)
    {
        return app('weixin')->sendMsgToTag($request->get('content'), $request->get('tagId'));
    }

    public function sendMsgToUser(SendMsgRequest $request)
    {
        return app('weixin')->sendMsgToUser($request->get('content'), $request->get('users'));
    }

    public function sendImgToUser(SendImgRequest $request)
    {
        return app('weixin')->sendImgToUser($request->get('media_id'), $request->get('users'));
    }

    public function getMemberInfo()
    {
        return app('weixin')->getMemberInfo();
    }

    public function getFile(GetFileRequest $request)
    {
        $filePath = base_path() . '\resources\downloads\\' . $request->get('fileName');
        return app('weixin')->getFile($request->get('media_id'), $filePath);
    }

    public function getForeverFile(GetForeverFileRequest $request)
    {
        $filePath = base_path() . '\resources\downloads\\' . $request->get('fileName');
        return app('weixin')->getForeverFile($request->get('media_id'), $filePath);
    }

    public function getForeverFileList(ForeverFileListRequest $request)
    {
        return app('weixin')->getForeverFileList($request->get('type'));
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $filePath = base_path() . '\resources\uploads\reports\excel\\' . $request->get('fileName');
        return app('weixin')->uploadFile($filePath);
    }

    public function uploadImage(UploadImageRequest $request)
    {
        $filePath = base_path() . '\resources\uploads\reports\image\\' . $request->get('fileName');
        return app('weixin')->uploadImage($filePath);
    }

    public function uploadNewsImg(UploadImageRequest $request)
    {
        $filePath = base_path() . '\resources\uploads\reports\image\\' . $request->get('fileName');
        return app('weixin')->uploadNewsImg($filePath);
    }

    public function uploadForeverMedia(UploadFileRequest $request)
    {
        $filePath = base_path() . '\resources\uploads\reports\excel\\' . $request->get('fileName');
        return app('weixin')->uploadForeverMedia($filePath);
    }

    public function sendNews(SendNewsRequest $request)
    {
        $filePath = base_path() . '\resources\uploads\reports\image\\' . $request->get('fileName');
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
        $redirect_url = $request->get('url');
        $users = $request->get('users');
        $filePath = base_path() . '\resources\uploads\reports\image\\' . $request->get('fileName');
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

        switch (strtoupper($report->format)) {
            case 'TEXT': {
                $snapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'TEXT');
                $content = $snapshot->abstract;
                return app('weixin')->sendMsgToUser($content, $userNames);
            };
                break;
            case 'IMAGE': {
                $snapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'IMAGE');
                $filePath = $snapshot->file_path . '\\' . $snapshot->file_name;
                $media_id = app('weixin')->uploadImage($filePath);

                return app('weixin')->sendImgToUser($media_id['media_id'], $userNames);
            }
                break;
            case 'FILE': {
                $snapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'EXCEL');
                $filePath = $snapshot->file_path . '\\' . $snapshot->file_name;
                $media_id = app('weixin')->uploadFile($filePath);

                return app('weixin')->sendFileToUser($media_id, $userNames);
            }
                break;
            case 'MPNEWS': {
                try{
                    $imgSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'IMAGE');
                    $htmlSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'HTML');
                    $xlsSnapshot = $this->snapshots->getSnapshotsByReportId($report->report_id, 'EXCEL');
                }catch(\Exception $e){
                    throw new Exception('發送報表失敗，獲取報表快照錯誤',30007);
                }

                $xlsName = basename($htmlSnapshot->file_name, "." . substr(strrchr($htmlSnapshot->file_name, '.'), 1));
                $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/third/report/html/' . $xlsName . '?thirdLogin=true';
                $imgPath = $imgSnapshot->file_path . '\\' . $imgSnapshot->file_name;
                $media_id = app('weixin')->uploadImage($imgPath);

                $newsItem = new MpNewsItem();
                $newsItem->title = $imgSnapshot->abstract;
                $newsItem->thumb_media_id = $media_id['media_id'];
                $newsItem->content = $xlsSnapshot->abstract;
                $newsItem->digest = $htmlSnapshot->abstract;
                $newsItem->show_cover_pic = 1;

                return app('weixin')->sendMpNews($newsItem, $redirect_url, $userNames);
            }
                break;
            default:
                throw new Exception('發送報表失敗，不支持的發送類型',30008);
        }
    }
}