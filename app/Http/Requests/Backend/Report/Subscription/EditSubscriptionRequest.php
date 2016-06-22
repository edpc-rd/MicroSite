<?php

namespace App\Http\Requests\Backend\Report\Subscription;

use App\Http\Requests\Request;

/**
 * Class EditSubscriptionRequest
 * @package App\Http\Requests\Backend\Report\Subscription;
 */
class EditSubscriptionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-report-subscription');
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
