<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Access\Traits\AuthenticatesUsers;
use App\Repositories\Frontend\User\UserContract;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
class ThirdAuthenticate
{
    use AuthenticatesUsers;

    /**
     * @var UserContract
     */
    protected $user;

    /**
     * @param UserContract                 $user
     */
    public function __construct(
        UserContract $user
    )
    {
        $this->user = $user;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->get('id')?intval($request->get('id')):0;    //獲取企業微信id by hpq 2020-02-03
        if ($request->exists('thirdLogin')) {
            if ($this->thirdLogin($id)) {   //根據企業微信id授權 by hpq 2020-02-03
                return $next($request);
            }
        }
        return abort(403);
    }
}