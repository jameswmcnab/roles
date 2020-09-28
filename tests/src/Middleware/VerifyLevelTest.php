<?php

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Ultraware\Roles\Exceptions\LevelDeniedException;
use Ultraware\Roles\Middleware\VerifyLevel;

class VerifyLevelTest extends TestCase
{
    public function testUserSameLevel(): void
    {
        $guard = \Mockery::mock(Guard::class);
        $user = \Mockery::mock(User::class);
        $request = Request();
        $guard->shouldReceive('check')->once()->withNoArgs()->andReturn(true);
        $guard->shouldReceive('user')->once()->withNoArgs()->andReturn($user);
        $user->shouldReceive('level')->once()->andReturn(2);

        $verifyRole = new VerifyLevel($guard);
        $result = $verifyRole->handle($request, function (Request $request) {
            return 'next was called';
        }, 1);
        $this->assertEquals('next was called', $result);
    }

    public function testUserHigherLevel(): void
    {
        $guard = \Mockery::mock(Guard::class);
        $user = \Mockery::mock(User::class);
        $request = Request();
        $guard->shouldReceive('check')->once()->withNoArgs()->andReturn(true);
        $guard->shouldReceive('user')->once()->withNoArgs()->andReturn($user);
        $user->shouldReceive('level')->once()->andReturn(3);

        $verifyRole = new VerifyLevel($guard);
        $result = $verifyRole->handle($request, function (Request $request) {
            return 'next was called';
        }, 2);
        $this->assertEquals('next was called', $result);
    }

    public function testUserLowerLevel_throwsException(): void
    {
        $guard = \Mockery::mock(Guard::class);
        $user = \Mockery::mock(User::class);
        $request = new Request();
        $guard->shouldReceive('check')->once()->withNoArgs()->andReturn(true);
        $guard->shouldReceive('user')->once()->withNoArgs()->andReturn($user);
        $user->shouldReceive('level')->once()->andReturn(1);

        $this->expectException(LevelDeniedException::class);
        $verifyRole = new VerifyLevel($guard);
        $verifyRole->handle($request, function (Request $request) {
        }, 2);
    }
}
