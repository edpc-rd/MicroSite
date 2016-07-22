<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportAttribute;
use App\Models\Report\Traits\Relationship\ReportRelationship;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use ReportRelationship, ReportAttribute;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'report_id';

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
    protected $guarded = ['report_id'];

    /**
     *@var array
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('report.reports_table');
    }

}
