<?php

namespace App\Api\V1\Requests\Weixin;

use App\Http\Requests\Request;

/**
 * Class GetForeverFileRequest
 * @package App\Api\V1\Requests\Weixin
 */
class GetForeverFileRequest extends Request
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
            'media_id' => 'required|string',
            'fileName' => 'required|string',
//            'wxId' => 'required|exists:ms_wx_config,id',
        ];
    }
}
