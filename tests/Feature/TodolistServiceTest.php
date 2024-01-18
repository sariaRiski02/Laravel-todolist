<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }


    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo('1', 'riski');
        $todolist = Session::get('todolist');
        foreach ($todolist as $value) {
            self::assertEquals('1', $value['id']);
            self::assertEquals('riski', $value['todo']);
        }
    }


    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodoList());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'riski'
            ],
            [
                'id' => '2',
                'todo' => 'saria'
            ]
        ];

        $this->todolistService->saveTodo('1', 'riski');
        $this->todolistService->saveTodo('2', 'saria');

        // var_dump($this->todolistService->getTodoList());

        self::assertEquals($expected, $this->todolistService->getTodoList());
    }

    public function testRemoveTodolist()
    {
        $this->todolistService->saveTodo('1', 'riski');
        $this->todolistService->saveTodo('2', 'saria');


        $this->todolistService->removeTodo('3');

        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('2');
        self::assertEquals(0, sizeof($this->todolistService->getTodoList()));
    }
}
