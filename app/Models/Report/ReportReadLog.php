<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportReadLogAttribute;
use App\Models\Report\Traits\Relationship\ReportReadLogRelationship;
use Illuminate\Database\Eloquent\Model;

class ReportReadLog extends Model
{
    use ReportReadLogAttribute,ReportReadLogRelationship;
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
    protected $table = 'ms_reports_read_log';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];

}
