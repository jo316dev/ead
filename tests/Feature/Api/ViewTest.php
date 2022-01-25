<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Traits\TestTrait;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use TestTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_make_viewed_unauthorized()
    {
        $response = $this->postJson('/lessons/viewed');

        $response->assertStatus(401);
    }


    public function test_make_viewed_not_found()
    {
        $response = $this->postJson('/lessons/viewed', [], $this->getAuthorization());

        $response->assertStatus(422);
    }

    public function test_make_viewed_valid()
    {
        $lesson = Lesson::factory()->create();

        $payload = ['lesson' => $lesson->id];

        $response = $this->postJson('/lessons/viewed', $payload, $this->getAuthorization());

        $response->assertStatus(200);
    }
}
