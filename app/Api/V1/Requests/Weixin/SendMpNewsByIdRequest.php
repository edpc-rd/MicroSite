<?php

namespace App\Api\V1\Requests\Weixin;

use App\Http\Requests\Request;

/**
 * Class SendMpNewsByIdRequest
 * @package App\Api\V1\Requests\Weixin
 */
class SendMpNewsByIdRequest extends Request
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
            'reportId' => 'required|exists:ms_reports,report_id',
            'wxId' => 'required|exists:ms_wx_config,id',
        ];
    }
}
