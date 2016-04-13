<?php

namespace App\Models\Access\Role\Traits\Attribute;

/**
 * Class RoleAttribute
 * @package App\Models\Access\Role\Traits\Attribute
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-roles')) {
            return '<a href="' . route('admin.access.roles.edit', $this->role_id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //Can't delete master admin role
        if ($this->role_id != 1) {
            if (access()->allow('delete-roles')) {
                return '<a href="' . route('admin.access.roles.destroy', $this->role_id) . '" class="btn btn-xs btn-danger" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
            }
        }

        return '';
    }
}