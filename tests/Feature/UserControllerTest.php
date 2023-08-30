<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreateUser()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest', // Specify AJAX request
        ])->post('/register', $userData);

        $response->assertStatus(302); // Since registration redirects after success

        // If you want to assert the user creation, you can fetch the user from the database
        $user = User::where('email', $userData['email'])->first();
        $this->assertNotNull($user);
    }

    public function testGetUser()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->getJson('api/user'); // Use /user instead of /home

    $response->assertStatus(200);
    $response->assertJsonStructure(['id', 'name', 'email']);
}


}