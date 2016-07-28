<?php

namespace App\Http\Requests\Backend\Access\User\Subscription;

use App\Http\Requests\Request;

/**
 * Class StoreSubscriptionRequest
 * @package App\Http\Requests\Backend\Access\User\Subscription
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
            //
        ];
    }
}
