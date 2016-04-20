<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportGroupAttribute;
use App\Models\Report\Traits\Relationship\ReportGroupRelationship;
use Illuminate\Database\Eloquent\Model;

class ReportGroup extends Model
{
    use ReportGroupRelationship, ReportGroupAttribute;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'group_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['group_id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('report.report_group_table');
    }
}
