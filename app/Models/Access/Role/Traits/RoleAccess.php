<?php

namespace App\Models\Access\Role\Traits;

/**
 * Class RoleAccess
 * @package App\Models\Access\Role\Traits
 */
trait RoleAccess
{
    /**
     * Save the inputted permissions.
     *
     * @param  mixed  $inputPermissions
     * @return void
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        } else {
            $this->permissions()->detach();
        }
    }

    /**
     * Attach multiple permissions to current role.
     *
     * @param  mixed $permissions
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Attach permission to current role.
     *
     * @param  object|array $permission
     * @return void
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['permission_id'];
        }

        $this->permissions()->attach($permission);
    }

    /**
     * Detach multiple permissions from current role
     *
     * @param  mixed  $permissions
     * @return void
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    /**
     * Detach permission form current role.
     *
     * @param  object|array $permission
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['permission_id'];
        }

        $this->permissions()->detach($permission);
    }
}