<?php

namespace App\Models\Report\Traits\Attribute;

use App\Models\Report\Report;
use App\Models\Wxconfig\Wxconfig;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait ReportReadLogsAttribute
{
//    public function getNameAttribute(){
//        $report = Report::where('report_id',$this->report_id);
//        return $report->name;
//    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getStatusButtonAttribute();
    }

    /**
     * @return string
     */
    public function getStatusButtonAttribute()
    {
//        switch ($this->status) {
//            case 0:
//                return '';
//                break;
//            default:
//                if (access()->allow('reactivate-logs')) {
//                    return '<a href="' . route('admin.logs.logs.mark', [$this->id, 0]) .
//                        '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
//                        trans('buttons.backend.report.report.send') . '"></i></a> ';
//                }
//                return '';
            // No break
//        }
        if (access()->allow('reactivate-logs')) {
            return '<a href="' . route('admin.logs.logs.mark', [$this->id, 0]) .
                '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
                trans('buttons.backend.report.report.send') . '"></i></a> ';
        }
        return '';
    }
}
