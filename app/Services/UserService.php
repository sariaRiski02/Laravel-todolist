<?php

namespace App\Services;

interface UserService
{
    function login(string $user, string $pass): bool;
}
