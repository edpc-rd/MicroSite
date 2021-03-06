<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Attribute\PermissionGroupAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionGroupRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionGroup
 * @package App\Models\Access\Permission
 */
class PermissionGroup extends Model
{
    use PermissionGroupRelationship, PermissionGroupAttribute;

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
        $this->table = config('access.permission_group_table');
    }
}