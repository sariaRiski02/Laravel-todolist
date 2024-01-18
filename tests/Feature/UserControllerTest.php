<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "riski",
            "password" => "rahasia"
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'riski');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('user or password is required');
    }
    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])->assertSeeText('User or Password is wrong');
    }

    public function testLogout()
    {
        $this->withSession([
            'user' => 'riski'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLoginAlreadyLogin()
    {
        $this->withSession([
            'user' => 'riski'
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/login');
    }
}
