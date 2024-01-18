<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        if ($request->session()->exists('user')) {
            return redirect('/todolist');
        }
        return redirect('/login');
    }
}
