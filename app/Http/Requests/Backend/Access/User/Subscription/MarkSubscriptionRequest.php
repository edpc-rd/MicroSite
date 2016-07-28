<?php

namespace App\Http\Requests\Backend\Access\User\Subscription;

use App\Http\Requests\Request;

/**
 * Class MarkSubscriptionRequest
 * @package App\Http\Requests\Backend\Access\User\Subscription
 */
class MarkSubscriptionRequest extends Request
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
                return access()->allow('unsubscription-reports');
            break;

            case 1:
                return access()->allow('subscription-reports');
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
