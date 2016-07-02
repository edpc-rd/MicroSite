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
use Log;
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
            'agentid' => config('qy-wechat.agent_id'),  //应用的id
        );
        $server = new Server($options);
        return $server;
    }

    /**
     * @param  string $content
     * @param  integer $tagId
     * @param  integer $agentId
     * @return json $result
     */
    public function sendMsgToTag($content, $tagId, $agentId = 3)
    {
        $message = Message::make('text')->content($content);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->toTag($tagId);
        Log::info('推送企業號信息成功[文字].');
        return $result;
    }

    /**
     * @param  string $content
     * @param  string|array $users
     * @param  integer $agentId
     * @return json $result
     */
    public function sendMsgToUser($content, $users = '@all', $agentId = 3)
    {
        $message = Message::make('text')->content($content);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        Log::info('推送企業號信息成功[文字].');
        return $result;
    }

    /**
     * @param  string $mediaId
     * @param  string $users
     * @param  integer $agentId
     * @return json $result
     */
    public function sendImgToUser($mediaId, $users = '@all', $agentId = 3)
    {
        $message = Message::make('image')->media_id($mediaId);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        Log::info('推送企業號信息成功[圖片]:' . $mediaId);
        return $result;
    }

    /**
     * @param  string $mediaId
     * @param  string $users
     * @param  integer $agentId
     * @return json $result
     */
    public function sendFileToUser($mediaId, $users = '@all', $agentId = 3)
    {
        $message = Message::make('file')->media_id($mediaId);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        Log::info('推送企業號信息成功[文檔]:' . $mediaId);
        return $result;
    }

    /**
     * @param  string $mediaId
     * @param  string $filePath
     * @return json $result
     */
    public function getFile($mediaId, $filePath)
    {
        $result = $this->media->download($mediaId, $filePath);
        Log::info('獲取企業號素材成功[文檔]:' . $mediaId);
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
    public function getForeverFileList($type, $agentId = 3)
    {
        $result = $this->media->lists($type, 0, 20, $agentId);
        Log::info('獲取企業號永久素材列表成功.');
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
        $result = $this->memLogin->getLoginUrl(URL::route('member.login'), 'member');
        return $result;
    }

    /**
     * @param  string $filePath
     * @return json $result
     */
    public function uploadFile($filePath)
    {
        $result = $this->media->file($filePath);
        Log::info('上傳企業號臨時素材成功[文檔]：' . $result );
        return $result;
    }

    /**
     * @param  string $filePath
     * @return json $result
     */
    public function uploadImage($filePath)
    {
        $result = $this->media->image($filePath);
        Log::info('上傳企業號臨時素材成功[圖片]：' . $result['media_id'] );
        return $result;
    }

    /**
     * @param  string $filePath
     * @return json $result
     */
    public function uploadNewsImg($filePath)
    {
        $result = $this->media->uploadImg($filePath);
        Log::info('上傳企業號圖文信息內圖片成功：' . $result );
        return $result;
    }

    /**
     * @param  string $filePath
     * @param  integer $agentId
     * @return json $result
     */
    public function uploadForeverMedia($filePath, $agentId = 3)
    {
        $result = $this->media->forever($agentId)->image($filePath);
        Log::info('上傳企業號永久素材成功：' . $result );
        return $result;
    }

    /**
     * @param  string $media_id
     * @param  integer $agentId
     * @param  string $filePath
     * @return json $result
     */
    public function getForeverFile($media_id, $filePath, $agentId = 3)
    {
        $result = $this->media->forever($agentId)->download($media_id, $filePath);
        Log::info('獲取企業號永久素材成功：' . $result );
        return $result;
    }

    /**
     * @param  NewsItem $newsItem
     * @param  integer $agentId
     * @param  string|array $users
     * @return json $result
     */
    public function sendNews(NewsItem $newsItem, $users = '@all', $agentId = 3)
    {
        $message = Message::make('news')->item($newsItem);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        Log::info('發送企業號普通圖文信息成功：' . $newsItem->title );
        return $result;
    }

    /**
     * @param  MpNewsItem $newsItem
     * @param  integer $agentId
     * @param  string $users
     * @param  string $redirect_url
     * @return json $result
     */
    public function sendMpNews(MpNewsItem $newsItem, $redirect_url, $users = '@all', $agentId = 3)
    {
        $newsItem->content_source_url = $this->auth->url($redirect_url);
        $message = Message::make('mp_news')->item($newsItem);
        $result = $this->broadcast->fromAgentId($agentId)->send($message)->to($users);
        Log::info('發送企業號詳細圖文信息成功：' . $newsItem->title );
        return $result;
    }

}