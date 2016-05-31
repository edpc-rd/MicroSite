<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
use Log;

include_once 'WXBizMsgCrypt.php';


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
        // 假设企业号在公众平台上设置的参数如下
        // 假设企业号在公众平台上设置的参数如下
        $encodingAesKey = "KoGCoHUrYfLx7Cfc6cdUC3wFU3u76tiXUeKEBxBUwUE";
        $token = "PGchdzHXi5K";
        $corpId = "wx3b01abe2ac9a2785";//需要更换

        /*
        ------------使用示例一：验证回调URL---------------
        *企业开启回调模式时，企业号会向验证url发送一个get请求
        假设点击验证时，企业收到类似请求：
        * GET /cgi-bin/wxpush?msg_signature=5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3&timestamp=1409659589&nonce=263014780&echostr=P9nAzCzyDtyTWESHep1vC5X9xho%2FqYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp%2B4RPcs8TgAE7OaBO%2BFZXvnaqQ%3D%3D
        * HTTP/1.1 Host: qy.weixin.qq.com

        接收到该请求时，企业应
        1.解析出Get请求的参数，包括消息体签名(msg_signature)，时间戳(timestamp)，随机数字串(nonce)以及公众平台推送过来的随机加密字符串(echostr),
        这一步注意作URL解码。
        2.验证消息体签名的正确性
        3. 解密出echostr原文，将原文当作Get请求的response，返回给公众平台
        第2，3步可以用公众平台提供的库函数VerifyURL来实现。

        */

        $sVerifyMsgSig = $_GET["msg_signature"];
    //    $sVerifyMsgSig = "5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3";
        $sVerifyTimeStamp = $_GET["timestamp"];
     //   $sVerifyTimeStamp = "1409659589";
        $sVerifyNonce = $_GET["nonce"];
     //   $sVerifyNonce = "263014780";
        $sVerifyEchoStr = $_GET["echostr"];
      //  $sVerifyEchoStr = "P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ==";

// 需要返回的明文
        $sEchoStr = "";
        $wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        $errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
        if ($errCode == 0) {
            // 验证URL成功，将sEchoStr返回
            echo $sEchoStr;
        } else {
            print("ERR: " . $errCode . "\n\n");
        }
    }

}