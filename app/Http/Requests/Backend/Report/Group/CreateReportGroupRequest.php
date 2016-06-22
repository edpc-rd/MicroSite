<?php

namespace App\Http\Requests\Backend\Report\Group;

use App\Http\Requests\Request;

/**
 * Class CreateReportGroupRequest
 * @package App\Http\Requests\Backend\Report\Group
 */
class CreateReportGroupRequest extends Request
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
            //
        ];
    }
}
