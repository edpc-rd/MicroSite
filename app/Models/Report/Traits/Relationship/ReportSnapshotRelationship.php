<?php

namespace App\Models\Report\Traits\Relationship;

/**
 * Class ReportRelationship
 * @package App\Models\Access\Report\Traits\Relationship
 */

trait ReportSnapshotRelationship
{

    /**
     * @return mixed
     */
    public function report()
    {
        return $this->belongsTo(config('report.report'), 'report_id');
    }

}