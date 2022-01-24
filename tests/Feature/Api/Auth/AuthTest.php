<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fail_auth()
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function test_auth()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'teste'
        ]);



        $response->assertStatus(200);
    }

    public function test_logout_error()
    {
        $response = $this->postJson('/logout', []);

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $user = User::factory()->create();

        $token = $user->createToken('teste')->plainTextToken;

        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    public function test_myprofile_error()
    {
        $response = $this->getJson('/myprofile');

        $response->assertStatus(401);
    }

    public function test_myprofile()
    {
        $user = User::factory()->create();

        $token = $user->createToken('teste')->plainTextToken;

        $response = $this->getJson('/myprofile', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }
}
