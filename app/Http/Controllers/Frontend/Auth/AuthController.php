<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Access\Traits\ConfirmUsers;
use App\Services\Access\Traits\UseSocialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Repositories\Frontend\User\UserContract;
use App\Services\Access\Traits\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController
 * @package App\Http\Controllers\Frontend\Auth
 */
class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ConfirmUsers, ThrottlesLogins, UseSocialite;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Where to redirect users after they logout
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * 报表文件基础路径
     *
     * @var string
     */
    protected $bascPath;

    /**
     * @param UserContract $user
     */
    public function __construct(UserContract $user)
    {
        $this->user = $user;
        $this->bascPath = '/home/reportfile/resources/uploads/reports'.DIRECTORY_SEPARATOR;
    }

    /**
     * 清除多余报表
     */
    public function reportClear(){
        $path = $this->bascPath;
        $files = $this->getDir($path);
        if(!empty($files)){
            foreach ($files as $v){
                //获取文件修改时间
                $time = filemtime($v);
                //获取15天之前的时间
                $beforetime = strtotime("-15 days");
                if($time < $beforetime){  //一个月内没有修改过的文件删除掉
                    @unlink($v);
                }
            }
        }
    }
    /**
     * 使用scandir 遍历目录
     *
     * @param $path
     * @return array
     */
    function getDir($path = '../resources/uploads/reports')
    {
        //判断目录是否为空
        if(!file_exists($path)) {
            return [];
        }

        $files = scandir($path);
        $fileItem = [];
        foreach($files as $v) {
            $newPath = $path .DIRECTORY_SEPARATOR . $v;
            if(is_dir($newPath) && $v != '.' && $v != '..') {
                $fileItem = array_merge($fileItem, $this->getDir($newPath));
            }else if(is_file($newPath)){
                $fileItem[] = $newPath;
            }
        }
        return $fileItem;
    }
}