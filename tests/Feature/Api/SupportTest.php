<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Support;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Traits\TestTrait;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use TestTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_my_supports_unauthenticated()
    {
        $response = $this->getJson('/mysupports');

        $response->assertStatus(401);
    }

    public function test_get_my_supports()
    {

        $user =  $this->createUser();

        Support::factory()->count(250)->create([
            'user_id' => $user->id
        ]);

        Support::factory()->count(250)->create();

        $token = $user->createToken('test')->plainTextToken;

        $response = $this->getJson('/mysupports', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)->assertJsonCount(500, 'data');
    }

    public function test_supports_unauthenticated()
    {

        $response = $this->getJson('/mysupports');

        $response->assertStatus(401);
    }


    public function test_get_supports_auth()
    {

        Support::factory()->count(50)->create();

        $response = $this->getJson('/mysupports', $this->getAuthorization());

        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }


    public function test_get_supports_filter_lesson()
    {
        $lesson = Lesson::factory()->create();

        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create([
            'lesson_id' => $lesson->id
        ]);

        $payload = ['lesson' => $lesson->id];

        $response = $this->json('GET', '/mysupports', $payload, $this->getAuthorization());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_create_my_supports_unauthenticated()
    {
        $response = $this->postJson('/supports');

        $response->assertStatus(401);
    }


    public function test_create_supports_error_auth()
    {
        $response = $this->postJson('/supports', [], $this->getAuthorization());

        $response->assertStatus(422);
    }

    public function test_create_supports_auth()
    {

        $lesson = Lesson::factory()->create();


        $payload = [
            'lesson_id' => $lesson->id,
            'status' => 'P',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id maxime, doloribus cupiditate, ut corrupti recusandae sit ipsum fugit omnis pariatur eligendi eum itaque saepe optio a consectetur iste quasi veritatis?'
        ];




        $response = $this->postJson('/supports', $payload, $this->getAuthorization());

        $response->assertStatus(201);
    }
}
