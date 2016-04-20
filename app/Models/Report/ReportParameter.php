<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\ReportParameterAttribute;
use App\Models\Report\Traits\Relationship\ReportParameterRelationship;
use Illuminate\Database\Eloquent\Model;

class ReportParameter extends Model
{
    use ReportParameterRelationship, ReportParameterAttribute;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'parameter_id';

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
    protected $guarded = ['parameter_id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('report.report_parameter_table');
    }
}
