<?php

namespace App\Models\Report\Traits\Relationship;

/**
 * Class ReportRelationship
 * @package App\Models\Access\Report\Traits\Relationship
 */

trait ReportGroupRelationship
{
    /**
     * @return mixed
     */
    public function reports()
    {
        return $this->hasMany(config('report.report'), 'group_id')->orderBy('name', 'asc');
    }

    /**
     * @return mixed
     */
    public function children()
    {
        return $this->hasMany(config('report.report_group'), 'parent_id', 'group_id')->orderBy('sort_order', 'asc');
    }
}