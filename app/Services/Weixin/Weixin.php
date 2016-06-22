<?php

namespace App\Services\Weixin;

use Stoneworld\Wechat\Server;
use Stoneworld\Wechat\Broadcast;
use Stoneworld\Wechat\Message;
use Stoneworld\Wechat\Media;
use Stoneworld\Wechat\Messages\NewsItem;
use Stoneworld\Wechat\Messages\MpNewsItem;
use Stoneworld\Wechat\Auth;
use Stoneworld\Wechat\MemberLogin;
use URL;
/**
 * Class Weixin
 * @package App\Services\Weixin
 */
class Weixin
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * @var Media
     */
    protected $media;

    /**
     * @var Broadcast
     */
    protected $broadcast;

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var MemberLogin
     */
    protected $memLogin;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->media = new Media(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $this->broadcast = new Broadcast(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $this->auth = new Auth(config('qy-wechat.app_id'), config('qy-wechat.secret'));
        $this->memLogin = new MemberLogin(config('qy-wechat.app_id'), config('qy-wechat.secret'));
    }

    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * Get the currently authenticated user's id
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * @param
     * @return json $result
     */
    public function server()
    {
        $options = array(
            'token' => config('qy-wechat.token'), //填写应用接口的Token
            'encodingaeskey' => config('qy-wechat.aes_key'), //填写加密用的EncodingAESKey
            'appid' => config('qy-wechat.app_id'), //填写高级调用功能的app id
            'appsecret' => config('qy-wechat.secret'), //填写高级调用功能的密钥
            'agentid' => config('qy-wechat.agentid'),  //应用的id
        );
        $server = new Server($options);
        return $server;
    }

    /**
     * @param  string $content
     * @param  integer $tagId
     * @return json $result
     */
    public function sendMsgToTag($content,$tagId)
    {
        $message = Message::make('text')->content($content);
        $result = $this->broadcast->fromAgentId('3')->send($message)->toTag($tagId);
        return $result;
    }

    /**
     * @param  string $mediaId
     * @param  string $users
     * @return json $result
     */
    public function sendImgToUser($mediaId,$users='@all')
    {
        $message = Message::make('image')->media_id($mediaId);
        $result = $this->broadcast->fromAgentId('3')->send($message)->to($users);
        return $result;
    }

    /**
     * @param  string $mediaId
     * @param  string $fileName
     * @return json $result
     */
    public function getFile($mediaId,$fileName)
    {
        $result = $this->media->download($mediaId,$fileName);
        return $result;
    }

    /**
     * @param
     * @return json $result
     */
    public function getMemberInfo()
    {
        $result = $this->auth->user();
        return $result;
    }

    /**
     * @param  string $type
     * @param  integer $agentId
     * @return json $result
     */
    public function getForeverFileList($type,$agentId)
    {
        $result = $this->media->lists($type, 0, 20, $agentId);
        return $result;
    }

    /**
     * @param
     * @return json $result
     */
    public function getLoginMember()
    {
        $member = $this->memLogin->member();
        return $member;
    }

    /**
     * @param
     * @return json $result
     */
    public function getLoginPage()
    {
        $result = $this->memLogin->getLoginUrl(URL::route('member.login'),'member');
        return $result;
    }

    /**
     * @param  string $filePath
     * @return json $result
     */
    public function uploadFile($filePath)
    {
        $result = $this->media->file($filePath);
        return $result;
    }

    /**
     * @param  string $filePath
     * @return json $result
     */
    public function uploadImage($filePath)
    {
        $result = $this->media->image($filePath);
        return $result;
    }

    /**
     * @param  string $filePath
     * @return json $result
     */
    public function uploadNewsImg($filePath)
    {
        $results =$this->media->uploadImg($filePath);
        return $results;
    }

    /**
     * @param  string $filePath
     * @param  string $agentId
     * @return json $result
     */
    public function uploadForeverMedia($filePath, $agentId)
    {
        $results = $this->media->forever($agentId)->image($filePath);
        return $results;
    }

    /**
     * @param  string $media_id
     * @param  string $agentId
     * @param  string $filePath
     * @return json $result
     */
    public function getForeverFile($media_id, $agentId, $filePath)
    {
        $results =$this->media->forever($agentId)->download($media_id, $filePath);
        return $results;
    }

    /**
     * @param  NewsItem $newsItem
     * @param  integer $agentId
     * @param  string $users
     * @return json $result
     */
    public function sendNews(NewsItem $newsItem, $agentId, $users)
    {
        $message = Message::make('news')->item($newsItem);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        return $result;
    }

    /**
     * @param  MpNewsItem $newsItem
     * @param  integer $agentId
     * @param  string $users
     * @param  string $redirect_url
     * @return json $result
     */
    public function sendMpNews(MpNewsItem $newsItem, $agentId, $redirect_url, $users)
    {
        $newsItem->content_source_url = $this->auth->url($redirect_url);
        $message = Message::make('mp_news')->item($newsItem);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        return $result;
    }

}