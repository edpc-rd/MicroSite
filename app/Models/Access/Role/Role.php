<?php

namespace App\Models\Access\Role;

use App\Models\Access\Role\Traits\Attribute\RoleAttribute;
use App\Models\Access\Role\Traits\Relationship\RoleRelationship;
use App\Models\Access\Role\Traits\RoleAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models\Access\Role
 */
class Role extends Model
{
    use RoleAccess, RoleAttribute, RoleRelationship;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'role_id';

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
    protected $guarded = ['role_id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('access.roles_table');
    }
}
