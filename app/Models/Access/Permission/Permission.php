<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Models\Access\Permission
 */
class Permission extends Model
{
    use PermissionRelationship, PermissionAttribute;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'permission_id';

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
    protected $guarded = ['permission_id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('access.permissions_table');
    }
}