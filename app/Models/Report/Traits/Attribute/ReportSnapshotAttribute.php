<?php

namespace App\Models\Report\Traits\Attribute;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait ReportSnapshotAttribute
{
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
        if (access()->allow('edit-report-snapshots')) {
            return '<a href="' . route('admin.report.report-snapshot.edit', $this->snapshot_id) .
            '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' .
            trans('buttons.general.crud.edit') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-report-snapshots')) {
            return '<a href="' . route('admin.report.report-snapshot.destroy', $this->snapshot_id) .
            '" class="btn btn-xs btn-danger" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="' .
            trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }
}
