<?php

namespace App\Models\Wxconfig\Traits\Attribute;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait WxconfigAttribute
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
        if (access()->allow('edit-wxconfigs')) {
            return '<a href="' . route('admin.wxconfig.wxconfigs.edit', $this->id) .
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
        switch ($this->status) {
            case 0:
                if (access()->allow('reactivate-wxconfigs')) {
                    return '<a href="' . route('admin.wxconfig.wxconfig.mark', [$this->id, 1]) .
                        '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
                        trans('buttons.backend.wxconfig.wxconfig.activate') . '"></i></a> ';
                }

                break;

            case 1:
                if (access()->allow('deactivate-wxconfigs')) {
                    return '<a href="' . route('admin.wxconfig.wxconfig.mark', [$this->id, 0]) .
                        '" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="' .
                        trans('buttons.backend.wxconfig.wxconfig.deactivate') . '"></i></a> ';
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
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-wxconfigs')) {
            return '<a href="' . route('admin.wxconfig.wxconfigs.destroy', $this->id) . '"
                 data-method="delete"
                 data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
                 data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }
}
