<?php

namespace App\Http\Requests\Backend\Report;

use App\Http\Requests\Request;

/**
 * Class DeleteReportRequest
 * @package App\Http\Requests\Backend\Report
 */
class DeleteReportRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-report');
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
