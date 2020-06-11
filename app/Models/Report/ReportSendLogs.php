<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportSendLogsAttribute;
use App\Models\Report\Traits\Relationship\ReportSendLogsRelationship;
use Illuminate\Database\Eloquent\Model;

class ReportSendLogs extends Model
{
    use ReportSendLogsAttribute,ReportSendLogsRelationship;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ms_report_send_logs';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];

}
