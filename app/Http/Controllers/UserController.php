<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private UserService $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    public function login(): Response
    {
        return response()
            ->view('user.index', [
                'title' => "Login"
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        // validate input

        if (empty($user) || empty($password)) {
            return response()->view('user.index', [
                'title' => 'Login',
                'error' => 'user or password is required'
            ]);
        }

        if ($this->UserService->login($user, $password)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()->view('user.index', [
            "title" => "Login",
            "error" => "User or Password is wrong"
        ]);
    }

    public function doLogout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
