<?php

namespace App\Http\Requests\Backend\Report\Parameter;

use App\Http\Requests\Request;

/**
 * Class UpdateParameterRequest
 * @package App\Http\Requests\Backend\Report\Parameter
 */
class UpdateParameterRequest extends Request
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
            'name' => 'required|string|max:50',
            'display_name' => 'required|string|max:50',
            'data_type' => 'required|string|max:20',
            'nullable' => 'required|in:true,false',
            'multi_value' => 'required|in:true,false',
            'default_value' => 'required|string|max:100',
        ];
    }
}
