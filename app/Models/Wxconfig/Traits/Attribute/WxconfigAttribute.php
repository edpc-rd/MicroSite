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
