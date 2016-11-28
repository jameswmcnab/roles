<?php

namespace Ultraware\Roles\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ultraware\Roles\Models\Permission;

interface RoleHasRelations
{
    /**
     * Role belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function permissions();

    /**
     * Role belongs to many users.
     *
     * @return BelongsToMany
     */
    public function users();

    /**
     * Attach permission to a role.
     *
     * @param int|Permission $permission
     * @return int|bool
     */
    public function attachPermission($permission);

    /**
     * Detach permission from a role.
     *
     * @param int|Permission $permission
     * @return int
     */
    public function detachPermission($permission);

    /**
     * Detach all permissions.
     *
     * @return int
     */
    public function detachAllPermissions();
}