<?php

namespace App\Http\Requests\Backend\Report;

use App\Http\Requests\Request;

/**
 * Class EditReportRequest
 * @package App\Http\Requests\Backend\Report;
 */
class EditReportRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-report');
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
