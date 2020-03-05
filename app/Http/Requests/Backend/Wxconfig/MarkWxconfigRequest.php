<?php

namespace App\Http\Requests\Backend\Wxconfig;

use App\Http\Requests\Request;

/**
 * Class MarkUserRequest
 * @package App\Http\Requests\Backend\Wxconfig
 */
class MarkWxconfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Get the 'mark' id
        switch ((int) request()->segment(6)) {
			
			case 0:
                return access()->allow('disable-wxconfigs');
            break;
			
            case 1:
                return access()->allow('enable-wxconfigs');
            break;
        }

        return false;
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
