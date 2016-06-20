<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use Stoneworld\Wechat\Server;
use Stoneworld\Wechat\Broadcast;
use Stoneworld\Wechat\Message;
use Stoneworld\Wechat\Media;
use Illuminate\Http\Request;
use Stoneworld\Wechat\Messages\NewsItem;
use Stoneworld\Wechat\Messages\MpNewsItem;
use Stoneworld\Wechat\Auth;
use Stoneworld\Wechat\MemberLogin;
/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */

class WeixinController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string

    public function serve_1()
    {
        function logg($text){
            file_put_contents('./log.txt',$text."\r\n\r\n",FILE_APPEND);
        };

        $options = array(
            'token'=>config('qy-wechat.token'), //填写应用接口的Token
            'encodingaeskey'=>config('qy-wechat.aes_key'), //填写加密用的EncodingAESKey
            'appid'=>config('qy-wechat.app_id'), //填写高级调用功能的app id
            'appsecret'=>config('qy-wechat.secret'), //填写高级调用功能的密钥
  		    'agentid'=>'3', //应用的id
  		    'debug'=>false, //调试开关
  		    '_logcallback'=>'logg', //调试输出方法，需要有一个string类型的参数
        );
        logg("GET参数为：\n".var_export($_GET,true));
        $weObj = new Wexin($options);
        $ret=$weObj->valid();
        if (!$ret) {
            logg("验证失败！");
            var_dump($ret);
            exit;
        }
        $f = $weObj->getRev()->getRevFrom();
        $t = $weObj->getRevType();
        $d = $weObj->getRevData();
        $weObj->text("你好！来自星星的：".$f."\n你发送的".$t."类型信息：\n原始信息如下：\n".var_export($d,true))->reply();
        logg("-----------------------------------------");
    }*/

    public function serve()
    {
        function logg($text){
            file_put_contents('./log.txt',$text."\r\n\r\n",FILE_APPEND);
        };

        $options = array(
            'token'=>config('qy-wechat.token'), //填写应用接口的Token
            'encodingaeskey'=>config('qy-wechat.aes_key'), //填写加密用的EncodingAESKey
            'appid'=>config('qy-wechat.app_id'), //填写高级调用功能的app id
            'appsecret'=>config('qy-wechat.secret'), //填写高级调用功能的密钥
            'agentid'=>config('qy-wechat.agentid'),  //应用的id
        );

        $server = new Server($options);

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

    public function sendMsg()
    {
        $message = Message::make('text')->content('This Msg From MicroSite！');
        $broadcast = new Broadcast(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $broadcast->fromAgentId('3')->send($message)->toAll();
    }

    public function sendImg()
    {
        //$message = Message::make('text')->content('This Msg From MicroSite！');
        $message = Message::make('image')->media_id('1TfkCO18VlsoIu8ptCci_UoLQkgbQuzpYtqv8t07U-MyLhmnCedaDNz_9fZLPt-jX9MDKbT8NHKjNCxhUwZQ8qg');
        $broadcast = new Broadcast(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $broadcast->fromAgentId('3')->send($message)->to('LinHuiMin');
    }

    public function sendNews()
    {
        $picUrl = $this->uploadNewsImg(public_path() . '/img/80591780457743455.png');

        $newsItem = new NewsItem();
        $newsItem->title = 'MicroSite News Test';
        $newsItem->description = 'News From MicroSite';
        $newsItem->pic_url = $picUrl;
        $newsItem->url = 'http://microsite.ngrok.cc/uploads/reports/html/R003_detail.html';
        $message = Message::make('news')->item($newsItem);
        $broadcast = new Broadcast(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $broadcast->fromAgentId('3')->send($message)->toAll();
    }

    public function sendMpNews()
    {
        $auth = new Auth(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $url = $auth->url('http://microsite.ngrok.cc/weixin/getUserInfo');
        $media_id = $this->uploadImage(public_path() . '/img/80591780457743455.png');
        $newsItem = new MpNewsItem();
        $newsItem->title = 'MicroSite MpNews Test!';
        $newsItem->thumb_media_id = $media_id['media_id'];
        $newsItem->author = 'EDPC_RD';
        $newsItem->content_source_url = $url;
        $newsItem->content = "<html><body style='background-color:PowderBlue;'><h1>CONTENT INFO</h1><p style='font-family:verdana;color:#c559ff;'>CONTENT INFO IN HTML FORMAT</p></body></html>";
        $newsItem->digest = 'SUMMARY INFO';
        $newsItem->show_cover_pic = 1;

        $message = Message::make('mp_news')->item($newsItem);
        $broadcast = new Broadcast(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $broadcast->fromAgentId('3')->send($message)->to('LinHuiMin');
    }

    public function getUserInfo()
    {
        $auth = new Auth(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $user = $auth->user();
        print_r($user);
    }

    public function getFile()
    {
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        //$results =$media->image(public_path() . '/img/20160420182930.png');
        $results =$media->download('1nwHxfnFww5lvili442bqmnDGbX2InvReaUROL0G2l6Q3oWVj8zDToEU0BjyonbYvyxC9LuFH9-_Ltf_o5OBp7w','DownloadTest');
        print_r($results);
    }

    public function getForeverFile(Request $request)
    {
        $media_id = $request->get('media_id');
        $media_id = '2i5yGnzO0bFxcfJ4qV91xoNTWff-f2N3hwRRTIHoTWfnz9MaImnE0QTXgcQnT1UAJfU53cQnnzxQp37Pqe11e8w';
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        //$results =$media->image(public_path() . '/img/20160420182930.png');
        $results =$media->forever(config('qy-wechat.agent_id'))->download($media_id,public_path() . '/downloads/DownloadTest');
        print_r($results);
    }

    public function getForeverFileList(Request $request)
    {
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        //$results =$media->image(public_path() . '/img/20160420182930.png');
        $results =$media->lists('image', 0, 20, config('qy-wechat.agent_id'));
        print_r(json_encode($results));
    }


    public function uploadFile($filename)
    {
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        return $media->file($filename);
    }

    public function uploadImage($filename)
    {
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        return $media->image($filename);
    }

    public function uploadNewsImg()
    {
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $results =$media->uploadImg(public_path() . '/img/80591780457743455.png');
        return $results;
    }

    public function uploadForeverMedia()
    {
        $media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $results = $media->forever(config('qy-wechat.agentid'))->image(public_path() . '/img/20160420182930.png');
        print_r($results);
    }

    public function getLoginPage($redirect_uri)
    {
        $memLogin = new MemberLogin(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        return $memLogin->getLoginUrl($redirect_uri);
    }

    public function getLoginInfo()
    {

        $memLogin = new MemberLogin(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $member = $memLogin->member();

        print_r($member);
    }

}