<?php

namespace App\Http\Requests\Backend\Access\User\Subscription;

use App\Http\Requests\Request;

/**
 * Class DeleteSubscriptionRequest
 * @package App\Http\Requests\Backend\Access\User\Subscription
 */
class DeleteSubscriptionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-report-subscriptions');
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
