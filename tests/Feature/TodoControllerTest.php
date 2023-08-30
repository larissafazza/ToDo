<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\TodoController;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Summary of testCreateTodo
     * @return void
     */
    public function testCreateTodo()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $todoData = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => now()->format('Y-m-d'),
            'priority' => 'high',
            'done' => false,
            'user_id' => $user->id
        ];

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest', // Specify AJAX request
        ])->postJson('todos', $todoData);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'todo' => ['id', 'title', 'description'],
        ]);
    }

    /**
     * Summary of testGetTodo
     * @return void
     */
    public function testGetTodo()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $userId = $user->id;
        $todo = Todo::factory()->userId($userId)->create();

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->getJson('todos/' . $todo->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'todo' => ['id', 'title', 'description'],
        ]);
    }

}
