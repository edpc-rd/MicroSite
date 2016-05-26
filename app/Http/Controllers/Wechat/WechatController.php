<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
use Log;

class WechatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve_test()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }

    public function serve()
    {
        include_once "WXBizMsgCrypt.php";

        // 假设企业号在公众平台上设置的参数如下
        $encodingAesKey = "yyaNeacqghYBasSEy4d4InUPwTCIbAkyf15fJ4CIfw3";
        $token = "aRAXM84VRIAq8Y3";
        $corpId = "wx3b01abe2ac9a2785";//需要更换


        $sVerifyMsgSig =$_GET["msg_signature"];
        $sVerifyTimeStamp =$_GET["timestamp"];
        $sVerifyNonce = $_GET["nonce"];
        $sVerifyEchoStr = $_GET["echostr"];
        // 需要返回的明文
        $sEchoStr = "";
        $wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        $errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
        if ($errCode == 0) {

            echo $sEchoStr;

        } else {
            print("ERR: " . $errCode . "\n\n");
        }
    }

}