<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $UserService;


    protected function setUp(): void
    {
        parent::setUp();
        $this->UserService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->UserService->login('riski', 'rahasia'));
    }
    public function testLoginUserNotFound()
    {
        self::assertFalse($this->UserService->login('false', 'false'));
    }

    public function testLoginWrongPass()
    {
        self::assertFalse($this->UserService->login('riski', 'false'));
    }
}
