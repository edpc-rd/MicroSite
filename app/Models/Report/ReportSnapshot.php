<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportSnapshotAttribute;
use App\Models\Report\Traits\Relationship\ReportSnapshotRelationship;
use Illuminate\Database\Eloquent\Model;

class ReportSnapshot extends Model
{
    use ReportSnapshotRelationship, ReportSnapshotAttribute;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'snapshot_id';

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
    protected $guarded = ['snapshot_id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('report.snapshots_table');
    }
}
