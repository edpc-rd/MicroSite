<?php

namespace App\Api\V1\Controllers\Weixin;

use App\Http\Controllers\Controller;
use Stoneworld\Wechat\Message;
use Illuminate\Http\Request;
use Stoneworld\Wechat\Messages\NewsItem;
use Stoneworld\Wechat\Messages\MpNewsItem;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */

class WeixinController extends Controller
{
    public function serve()
    {
        $server = app('weixin')->server();

        // 您可以直接echo 或者返回给框架
        //die($server->serve());

        $server->on('message', function($message) {
            return Message::make('text')->content('您好！' . $message->FromUserName . ':' . $message->Content );
        });

        $server->on('event', 'subscribe', function($event) {

            error_log('收到关注事件，关注者openid: ' . $event['FromUserName']);

            return Message::make('text')->content('感谢您关注');
        });

        $result = $server->serve();

        echo $result;
    }

    public function sendMsgToTag(Request $request)
    {
        return app('weixin')->sendMsgToTag($request->get('content'), $request->get('tagId'));
    }

    public function sendImgToUser(Request $request)
    {
        return app('weixin')->sendImgToUser($request->get('media_id'),$request->get('users'));
    }

    public function getMemberInfo()
    {
        return app('weixin')->getMemberInfo();
    }

    public function getFile(Request $request)
    {
        return app('weixin')->getFile($request->get('media_id'),app_path() . $request->get('filePath'));
    }

    public function getForeverFile(Request $request)
    {
        return app('weixin')->getForeverFile($request->get('media_id'),config('qy-wechat.agent_id'),app_path() . $request->get('filePath'));
    }

    public function getForeverFileList(Request $request)
    {
        return app('weixin')->getForeverFileList($request->get('type'), config('qy-wechat.agent_id'));
    }

    public function uploadFile(Request $request)
    {
        return app('weixin')->uploadFile(app_path() . $request->get('filePath'));
    }

    public function uploadImage(Request $request)
    {
        return app('weixin')->uploadImage(app_path() . $request->get('filePath'));
    }

    public function uploadNewsImg(Request $request)
    {
        return app('weixin')->uploadNewsImg(app_path() . $request->get('filePath'));
    }

    public function uploadForeverMedia(Request $request)
    {
        return app('weixin')->uploadForeverMedia(app_path() . $request->get('filePath'),config('qy-wechat.agent_id'));
    }

    public function sendNews(Request $request)
    {
        $picUrl = app('weixin')->uploadNewsImg(app_path() . $request->get('filePath'));
        $users = $request->get('users');
        $newsItem = new NewsItem();
        $newsItem->title = $request->get('title');
        $newsItem->description = $request->get('description');
        $newsItem->pic_url = $picUrl;
        $newsItem->url = $request->get('url');

        return app('weixin')->sendNews($newsItem,config('qy-wechat.agent_id'),$users);
    }

    public function sendMpNews(Request $request)
    {
        $url = $request->get('url');
        $users = $request->get('users');
        $media_id = app('weixin')->uploadImage(app_path() . $request->get('filePath'));
        $newsItem = new MpNewsItem();
        $newsItem->title = $request->get('title');
        $newsItem->thumb_media_id = $media_id['media_id'];
        $newsItem->author = $request->get('author');
        $newsItem->content = $request->get('content');
        $newsItem->digest = $request->get('digest');
        $newsItem->show_cover_pic = $request->get('show_cover_pic');

        return app('weixin')->sendMpNews($newsItem,config('qy-wechat.agent_id'),$url,$users);
    }
}