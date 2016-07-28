<?php

namespace App\Models\Access\User\Traits\Attribute;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait UserSubscriptionAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getStatusButtonAttribute() . ' ' .
        $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-report-subscriptions')) {
            return '<a href="' . route('admin.access.subscription.delete', [$this->id]) . '"
                 data-method="delete"
                 data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . trans('buttons.backend.access.subscriptions.deactivate') . '"
                 data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
                 class="btn btn-xs btn-danger"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.backend.access.subscriptions.deactivate') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getStatusButtonAttribute()
    {
        switch ($this->subscribe_status) {
            case 0:
                if (access()->allow('subscribe-reports')) {
                    return '<a href="' . route('admin.access.user.subscription.mark', [$this->id, 1]) .
                    '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
                    trans('buttons.backend.access.subscriptions.subscript') . '"></i></a> ';
                }

                break;
            case 1:
                if (access()->allow('unsubscription-reports')) {
                    return '<a href="' . route('admin.access.user.subscription.mark', [$this->id, 0]) .
                    '" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="' .
                    trans('buttons.backend.access.subscriptions.un_subscript') . '"></i></a> ';
                }

                break;

            default:
                return '';
            // No break
        }

        return '';
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->subscribe_status) {
            case 0:
                return "<label class='label label-danger'>" . trans('labels.general.no') . "</label>";
                break;
            case 1:
                return "<label class='label label-info'>" . trans('labels.general.yes') . "</label>";
                break;
            default:
                return '';

            // No break
        }
    }

}
