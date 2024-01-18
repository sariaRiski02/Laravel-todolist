<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }
    public function todolist(Request $request)
    {
        $todolist = $this->todolistService->getTodoList();
        return response()->view('todolist.todolist', [
            'title' => 'todolist',
            'todolist' => $todolist
        ]);
    }
    public function addTodo(Request $request)
    {
        $todolist = $this->todolistService->getTodoList();
        $todo = $request->input('todo');
        if (isset($todo)) {
            $this->todolistService->saveTodo(uniqid("todo"), $todo);
            return Redirect()->action([TodolistController::class, 'todolist']);
        } else {
            return response()->view('todolist.todolist', [
                'title' => 'todolist',
                'todolist' => $todolist,
                'error' => "Todo is required"
            ]);
        }
    }
    public function removeTodo(Request $request, string $id)
    {
        $this->todolistService->removeTodo($id);
        return Redirect()->action([TodolistController::class, 'todolist']);
    }
}
