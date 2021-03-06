<?php

namespace App\Http\Requests\Backend\Report\Group;

use App\Http\Requests\Request;

/**
 * Class StoreReportGroupRequest
 * @package App\Http\Requests\Backend\Report\Group
 */
class StoreReportGroupRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-report-groups');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:ms_report_groups',
        ];
    }
}
