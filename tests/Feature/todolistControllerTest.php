<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class todolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'riski',
            'todolist' => [
                [
                    "id" => "1",
                    "todo" => "riski"
                ],
                [
                    "id" => "2",
                    "todo" => "saria"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("riski")
            ->assertSeeText("2")
            ->assertSeeText("saria");
    }

    public function testTodolistFailed()
    {
        $this->withSession([
            "user" => "riski"
        ])->post('/todolist', [])->assertSeeText('Todo is required');
    }

    public function testTodolistSuccess()
    {
        $this->withSession([
            "user" => "riski"
        ])->post('/todolist', [
            'id' => '1',
            "todo" => "mari buat hal2 baik"
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            'user' => 'riski',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'riski'
                ],
                [
                    'id' => '2',
                    'todo' => 'saria'
                ]
            ]
        ])->post('/todolist/1/delete')->assertRedirect('/todolist');
    }
}
