<?php

namespace App\Api\V1\Requests\Weixin;

use App\Http\Requests\Request;

/**
 * Class SendMpNewsRequest
 * @package App\Api\V1\Requests\Weixin
 */
class SendMpNewsRequest extends Request
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
            'fileName' => 'required|string',
            'users' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'digest' => 'required|string',
            'show_cover_pic' => 'required|integer',
            'url' => 'required|string',
            'author' => 'string',
            'wxId' => 'required|exists:ms_wx_config,id',
        ];
    }
}
