<?php

use App\Database\Factories\PermissionFactory;
use App\Database\Factories\RoleFactory;
use App\Database\Factories\UserFactory;
use App\User;

class PermissionHasRelationsTest extends \TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->runMigrations();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $this->setupDbConfig($app);
        parent::getEnvironmentSetUp($app);
    }

    public function testPermissionHasRoles(): void
    {
        $role = RoleFactory::new()->create();
        $permission = PermissionFactory::new()->create();
        $role->permissions()->attach($permission);
        $this->assertEquals($role->id, $permission->roles->first()->id);
        $this->assertEquals($role->slug, $permission->roles->first()->slug);
    }

    public function testPermissionHasUsers(): void
    {
        /** @var User $user */
        $user = UserFactory::new()->create();
        $permission = PermissionFactory::new()->create();
        $user->userPermissions()->attach($permission);
        $this->assertEquals($user->id, $permission->users->first()->id);
        $this->assertEquals($user->name, $permission->users->first()->name);
    }
}
