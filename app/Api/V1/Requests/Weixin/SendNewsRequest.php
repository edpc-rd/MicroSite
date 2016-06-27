<?php

namespace App\Api\V1\Requests\Weixin;

use App\Http\Requests\Request;

/**
 * Class SendNewsRequest
 * @package App\Api\V1\Requests\Weixin
 */
class SendNewsRequest extends Request
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
            'description' => 'required|string',
            'url' => 'required|string',
        ];
    }
}
