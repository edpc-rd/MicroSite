<?php

namespace App\Api\V1\Requests\Weixin;

use App\Http\Requests\Request;

/**
 * Class SendMsgRequest
 * @package App\Api\V1\Requests\Weixin
 */
class ServeRequest extends Request
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
//            'content' => 'required|string',
            'id' => 'integer',
//            'users' => 'sometimes|required|string',
        ];
    }
}
