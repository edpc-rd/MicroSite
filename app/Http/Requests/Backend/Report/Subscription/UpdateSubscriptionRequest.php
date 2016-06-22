<?php

namespace App\Http\Requests\Backend\Report\Subscription;

use App\Http\Requests\Request;

/**
 * Class UpdateSubscriptionRequest
 * @package App\Http\Requests\Backend\Report\Subscription
 */
class UpdateSubscriptionRequest extends Request
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
            'user_id' => 'required',
            'report_id' => 'required',
            'subscribe_status' => 'required|integer',
            'subscribe_time' => 'date',
        ];
    }
}
