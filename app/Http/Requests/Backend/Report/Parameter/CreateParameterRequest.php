<?php

namespace App\Http\Requests\Backend\Report\Parameter;

use App\Http\Requests\Request;

/**
 * Class CreateParameterRequest
 * @package App\Http\Requests\Backend\Report\Parameter
 */
class CreateParameterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-report-parameter');
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
