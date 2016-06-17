<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\Request;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Frontend\Auth
 */
class MemberLoginRequest extends Request
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
            'auth_code'  => 'required',
            'expires_in' => 'required',
            'state'      => 'required'
        ];
    }
}