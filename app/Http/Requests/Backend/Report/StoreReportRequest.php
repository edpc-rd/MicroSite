<?php

namespace App\Http\Requests\Backend\Report;

use App\Http\Requests\Request;

/**
 * Class StoreReportRequest
 * @package App\Http\Requests\Backend\Report
 */
class StoreReportRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-report');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'report_no' => 'required|string|max:10|unique:ms_reports',
            'group_id' => 'integer',
            'name' => 'required|string|max:100',
            'format' => 'required|string|max:20',
            'schedule' => 'string|max:100',
            'status' => 'required|integer',
            'allow_subscribe' => 'required|in:true,false',
            'allow_query' => 'required|in:true,false',
            'receive_mode' => 'string|max:50',
            'query_url' => 'string|max:200',
            'description' => 'string|max:200',
        ];
    }
}
