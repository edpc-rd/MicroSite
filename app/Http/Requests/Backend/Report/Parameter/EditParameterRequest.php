<?php

namespace App\Http\Requests\Backend\Report\Parameter;

use App\Http\Requests\Request;

/**
 * Class EditParameterRequest
 * @package App\Http\Requests\Backend\Report\Parameter;
 */
class EditParameterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-report-parameter');
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
