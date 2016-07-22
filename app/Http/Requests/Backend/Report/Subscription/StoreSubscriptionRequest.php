<?php

namespace App\Http\Requests\Backend\Report\Subscription;

use App\Http\Requests\Request;

/**
 * Class StoreSubscriptionRequest
 * @package App\Http\Requests\Backend\Report\Subscription
 */
class StoreSubscriptionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-report-subscriptions');
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
            'subscribe_status' => 'required|in:0,1',
            'subscribe_time' => 'date',
            'receive_mode' => 'required',
        ];
    }
}
