<?php

namespace App\Models\Report;

use App\Models\Report\Traits\Attribute\UserSubscriptionAttribute;
use App\Models\Report\Traits\Relationship\UserSubscriptionRelationship;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use UserSubscriptionRelationship, UserSubscriptionAttribute;

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
    protected $guarded = ['id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('report.user_subscriptions_table');
    }
}
