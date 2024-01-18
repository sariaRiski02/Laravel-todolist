<?php


namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{

    private array $users = [
        "riski" => "rahasia"
    ];
    public function login(string $user, string $pass): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $correctPassword === $pass;
    }
}
