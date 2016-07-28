<?php

namespace App\Models\Access\User\Traits\Relationship;

/**
 * Class ReportRelationship
 * @package App\Models\Access\Report\Traits\Relationship
 */

trait UserSubscriptionRelationship
{

    /**
     * @return mixed
     */
    public function report()
    {
        return $this->belongsTo(config('report.report'), 'report_id', 'report_id');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id', 'user_id');
    }
}