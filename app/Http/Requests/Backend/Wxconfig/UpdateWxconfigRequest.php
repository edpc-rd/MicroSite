<?php

namespace App\Http\Requests\Backend\Wxconfig;

use App\Http\Requests\Request;

/**
 * Class UpdateWxconfigRequest
 * @package App\Http\Requests\Backend\Wxconfig\Wxconfig
 */
class UpdateWxconfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-Wxconfigs');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'appid' => 'required|string',
            'appsecret' => 'required|string',
            'agentid' => 'required|int',
            'token' => 'required|string|max:100',
            'aeskey' => 'required|string|max:100'
        ];
    }
}
