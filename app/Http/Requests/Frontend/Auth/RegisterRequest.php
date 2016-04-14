<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\Request;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Frontend\Access
 */
class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|max:50',
            'user_nick' => 'required|max:50',
            'email' => 'required|email|max:60|unique:ms_users',
            'weixin_id' => 'required|max:60',
            'password' => 'required|confirmed|min:6',
            //'g-recaptcha-response' => 'required|captcha',
            'captcha' => 'required|captcha',
        ];
    }
}
