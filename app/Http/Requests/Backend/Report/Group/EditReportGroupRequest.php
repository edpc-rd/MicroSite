<?php

namespace App\Http\Requests\Backend\Report\Group;

use App\Http\Requests\Request;

/**
 * Class EditReportGroupRequest
 * @package App\Http\Requests\Backend\Report\Group
 */
class EditReportGroupRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-report-groups');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
