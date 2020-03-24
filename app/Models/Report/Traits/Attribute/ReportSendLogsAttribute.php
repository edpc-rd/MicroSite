<?php

namespace App\Models\Report\Traits\Attribute;

use App\Models\Wxconfig\Wxconfig;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait ReportSendLogsAttribute
{
    public function getWxNameAttribute(){
        $wxinfo = Wxconfig::where('status',1)->first();
        $wxconfig = Wxconfig::pluck('name','id');
        return $wxconfig[$this->wxid==0?$wxinfo->id:$this->wxid];
    }

    public function getStatusCodeAttribute(){
        return $this->status==0?'成功':'失敗';
    }

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
        switch ($this->status) {
            case 0:
                return '';
                break;
            default:
                if (access()->allow('reactivate-logs')) {
                    return '<a href="' . route('admin.logs.logs.mark', [$this->id, 0]) .
                        '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' .
                        trans('buttons.backend.report.report.send') . '"></i></a> ';
                }
                return '';
            // No break
        }

        return '';
    }
}
