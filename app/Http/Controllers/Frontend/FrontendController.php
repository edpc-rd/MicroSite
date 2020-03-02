<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wxconfig;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        javascript()->put([
            'test' => 'it works!',
        ]);
//        $agentid = app('weixin')->getAgentId();
//        $user = app('weixin')->setWxConfig(1);
//        var_dump($agentid);die;
//        $wx = Wxconfig::where(array('id' => 1))->get();
//        foreach ($wx as $val){
//            var_dump($val);die;
//        }

        return view('frontend.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
