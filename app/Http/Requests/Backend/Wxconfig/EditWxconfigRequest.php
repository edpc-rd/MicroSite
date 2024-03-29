<?php

namespace App\Http\Requests\Backend\Wxconfig;

use App\Http\Requests\Request;

/**
 * Class EditWxconfigRequest
 * @package App\Http\Requests\Backend\Wxconfig;
 */
class EditWxconfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-Wxconfigs');
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
