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
        if ($request->exists('thirdLogin')) {
            if ($this->thirdLogin()) {
                return $next($request);
            }
        }
        return redirect()->guest('login');
    }
}