<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\Attribute\UserSubscriptionAttribute;
use App\Models\Access\User\Traits\Relationship\UserSubscriptionRelationship;
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
     * @var array
     */
    protected $dates = ['subscribe_time'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     *
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('report.user_subscriptions_table');
    }
}
