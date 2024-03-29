<?php

namespace App\Http\Requests\Backend\Report\Parameter;

use App\Http\Requests\Request;

/**
 * Class DeleteParameterRequest
 * @package App\Http\Requests\Backend\Report\Parameter
 */
class DeleteParameterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-report-parameter');
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
