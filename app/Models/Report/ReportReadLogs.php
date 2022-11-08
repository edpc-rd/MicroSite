<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportReadLogsAttribute;
use App\Models\Report\Traits\Relationship\ReportReadLogsRelationship;
use Illuminate\Database\Eloquent\Model;

class ReportReadLogs extends Model
{
    use ReportReadLogsAttribute,ReportReadLogsRelationship;
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
    protected $table = 'ms_reports_read_logs';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];

}
