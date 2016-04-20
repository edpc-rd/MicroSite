<?php

namespace App\Models\Report\Traits\Attribute;

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
        return $this->getEditButtonAttribute() . ' ' .
        $this->getStatusButtonAttribute() . ' ' .
        $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-user-subscriptions')) {
            return '<a href="' . route('admin.report.user-subscription.edit', $this->id) .
            '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' .
            trans('buttons.general.crud.edit') . '"></i></a> ';
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
            case 2:
                if (access()->allow('subscribe-reports')) {
                    return '<a href="' . route('admin.report.user-subscription.mark', [$this->id, 1]) .
                    '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
                    trans('buttons.backend.report.report.activate') . '"></i></a> ';
                }

                break;
            case 1:
                if (access()->allow('deactivate-reports')) {
                    return '<a href="' . route('admin.report.user-subscription.mark', [$this->id, 2]) .
                    '" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="' .
                    trans('buttons.backend.report.report.deactivate') . '"></i></a> ';
                }

                break;

            default:
                return '';
            // No break
        }

        return '';
    }

}
