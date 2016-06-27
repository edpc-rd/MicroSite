<?php

namespace App\Models\Report\Traits\Relationship;

/**
 * Class ReportRelationship
 * @package App\Models\Access\Report\Traits\Relationship
 */

trait ReportRelationship
{

    /**
     * @return mixed
     */
    public function group()
    {
        return $this->belongsTo(config('report.report_group'), 'group_id');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'),
            config('report.user_subscriptions_table'), 'report_id', 'user_id')->where(['subscribe_status' => 1, 'status' => 1]);
    }

    /**
     * @return mixed
     */
    public function subscriptions()
    {
        return $this->hasMany(config('report.user_subscription'), 'report_id', 'report_id');
    }

    /**
     * @return mixed
     */
    public function snapshots()
    {
        return $this->hasMany(config('report.report_snapshot'), 'report_id', 'report_id');
    }

    /**
     * @return mixed
     */
    public function parameters()
    {
        return $this->hasMany(config('report.report_parameter'), 'report_id', 'report_id');
    }
}