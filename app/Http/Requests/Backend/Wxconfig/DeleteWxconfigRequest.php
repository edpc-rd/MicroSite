<?php

namespace App\Http\Requests\Backend\Wxconfig;

use App\Http\Requests\Request;

/**
 * Class DeleteWxconfigRequest
 * @package App\Http\Requests\Backend\Wxconfig
 */
class DeleteWxconfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-Wxconfigs');
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
