<?php

namespace App\Api\V1\Requests\Weixin;

use App\Http\Requests\Request;

/**
 * Class SendReportAgainRequest
 * @package App\Api\V1\Requests\Weixin
 */
class SendReportAgainRequest extends Request
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
            'id' => 'required|exists:ms_report_send_logs,id',
//            'wxId' => 'required|exists:ms_wx_config,id',
        ];
    }
}
