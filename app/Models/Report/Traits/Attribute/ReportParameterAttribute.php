<?php

namespace App\Models\Report\Traits\Attribute;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait ReportParameterAttribute
{
    /**
     * @return string
     */
    public function getMultiValueLabelAttribute()
    {
        if ($this->isMultiValue())
            return "<label class='label label-success'>" . trans('labels.general.yes') . "</label>";
        return "<label class='label label-danger'>" . trans('labels.general.no') . "</label>";
    }

    /**
     * @return bool
     */
    public function isMultiValue()
    {
        return $this->multi_value == 'true';
    }

    /**
     * @return string
     */
    public function getNullableLabelAttribute()
    {
        if ($this->isNullAble())
            return "<label class='label label-success'>" . trans('labels.general.yes') . "</label>";
        return "<label class='label label-danger'>" . trans('labels.general.no') . "</label>";
    }

    /**
     * @return bool
     */
    public function isNullAble()
    {
        return $this->nullable == 'true';
    }

    /**
     * @return string
     */

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() . ' ' . $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-report-parameters')) {
            return '<a href="' . route('admin.report.report-parameter.edit', $this->parameter_id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-report-parameters')) {
            return '<a href="' . route('admin.report.report-parameters.destroy', $this->parameter_id) . '" class="btn btn-xs btn-danger" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }
}
