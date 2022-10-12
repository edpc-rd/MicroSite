<?php

namespace App\Api\V1\Controllers\Auth;

use App\Api\V1\Controllers\BaseController;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\Jsn\JsnRepositoryContract;
use App\Repositories\Backend\Jsn\JsnToken\JsnTokenRepositoryContract;

class AuthController extends BaseController {

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var UserContract
     */
    protected $jsn;

    /**
     * @var UserContract
     */
    protected $jsnToken;

    public function __construct(
        UserContract $users,
        JsnRepositoryContract $jsn,
        JsnTokenRepositoryContract $jsnToken
    )
    {
        $this->users       = $users;
        $this->jsn         = $jsn;
        $this->jsnToken    = $jsnToken;
    }

    /**
     * @SWG\Post(
     *   path="/auth/login",
     *   summary="用户登录",
     *   tags={"Auth"},
     *   @SWG\Response(
     *     response=200,
     *     description="token"
     *   ),
     *   @SWG\Parameter(name="email", in="query", required=true, type="string", description="登录邮箱"),
     *   @SWG\Parameter(name="password", in="query", required=true, type="string", description="登录密码"),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */

    public function authenticate(Request $request) {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        return response()->json(compact('token'));

        /*just for test
            $user = $this->users->findOrThrowException(1);
            $token = JWTAuth::fromUser($user);
            return response()->json(compact('token'));
        */

    }
    /**
     * @SWG\Post(
     *   path="/auth/register",
     *   summary="用户注册",
     *   tags={"Auth"},
     *   @SWG\Response(
     *     response=200,
     *     description="register success"
     *   ),
     *   @SWG\Parameter(name="name", in="query", required=true, type="string", description="用户名"),
     *   @SWG\Parameter(name="email", in="query", required=true, type="string", description="登录邮箱"),
     *   @SWG\Parameter(name="password", in="query", required=true, type="string", description="登录密码"),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */

    /**聚水潭回调
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsnBack(Request $request) {
        $params = $request->all();
        $params['type'] = 0;
        file_put_contents('/web/website/laravel/MicroSite/Jsn.txt',json_encode($params) . "\n", FILE_APPEND);
        $this->jsn->create($params);
        $this->getJsnToken(@$params['code']);
        return response()->json(['code' => 0]);
    }

    /**获取聚水潭token
     * @param string $code
     */
    public function getJsnToken($code = ''){
         $url = 'https://openapi.jushuitan.com/openWeb/auth/accessToken';
         $params = [
             'app_key' => 'bdf1766a49fb4b4d90d72913163f31a1',
             'timestamp' => time(),
             'grant_type' => 'authorization_code',
             'charset' => 'utf-8',
             'code' => $code
         ];
        $params['sign'] = $this->getJsnSign("fd9841d685fd41c49eca8d368034bfff", $params);
//        $header = array("Content-Type: multipart/form-data;charset='utf-8'","Accept:application/json");
        $header = [];
        $res = $this->posturl($url,$params,$header);
        file_put_contents('/web/website/laravel/MicroSite/JsnToken.txt',json_encode($res) . "\n", FILE_APPEND);
        $res['type'] = 0;
        $this->jsnToken->create($res);
    }

    /**获取聚水潭签名
     * @param $sign_key
     * @param $data
     * @return string|null
     */
    public function getJsnSign($sign_key,$data)
    {
        if ($data == null) {
            return null;
        }
        ksort($data);
        $result_str = "";
        foreach ($data as $key => $val) {
            if ( $key != null && $key != "" && $key != "sign" ) {
                $result_str = $result_str . $key . $val;
            }
        }
        $result_str = $sign_key . $result_str;

        $ret = bin2hex(md5($result_str, true));

        return $ret;
    }

    /**聚水潭回调
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pddBack(Request $request) {
        $params = $request->all();
        $params['type'] = 1;
        file_put_contents('/web/website/laravel/MicroSite/Pdd.txt',json_encode($params) . "\n", FILE_APPEND);
        $this->jsn->create($params);
        return response()->json(['code' => 0]);
    }

    public function posturl($url,$data,$header){
        //$data  = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0    );//设置是否返回header信息
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output,true);
    }

    /**抖音回调
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dyBack(Request $request) {
        $params = $request->all();
        $params['type'] = 2;
        file_put_contents('/web/website/laravel/MicroSite/DY.txt',json_encode($params) . "\n", FILE_APPEND);
        $this->jsn->create($params);
//        $this->getJsnToken(@$params['code']);
        return response()->json(['code' => 0]);
    }
}
