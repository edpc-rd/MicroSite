<?php

namespace App\Models\Report\Traits\Attribute;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait ReportAttribute
{

    /**
     * @return string
     */
    public function getAllowSubscribeLabelAttribute()
    {
        if ($this->isAllowSubscribe())
            return "<label class='label label-success'>" . trans('labels.general.yes') . "</label>";
        return "<label class='label label-danger'>" . trans('labels.general.no') . "</label>";
    }

    /**
     * @return bool
     */
    public function isAllowSubscribe()
    {
        return $this->allow_subscribe == 'true';
    }

    /**
     * @return string
     */
    public function getAllowQueryLabelAttribute()
    {
        if ($this->isAllowQuery())
            return "<label class='label label-success'>" . trans('labels.general.yes') . "</label>";
        return "<label class='label label-danger'>" . trans('labels.general.no') . "</label>";
    }

    /**
     * @return bool
     */
    public function isAllowQuery()
    {
        return $this->allow_query == 'true';
    }

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
        if (access()->allow('edit-reports')) {
            return '<a href="' . route('admin.report.report.edit', $this->report_id) .
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
                if (access()->allow('reactivate-reports')) {
                    return '<a href="' . route('admin.report.report.mark', [$this->report_id, 1]) .
                    '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
                    trans('buttons.backend.report.report.activate') . '"></i></a> ';
                }

                break;

            case 1:
                if (access()->allow('deactivate-reports')) {
                    return '<a href="' . route('admin.report.report.mark', [$this->report_id, 0]) .
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

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-reports')) {
            return '<a href="' . route('admin.report.report.destroy', $this->report_id) . '"
                 data-method="delete"
                 data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
                 data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }
}
