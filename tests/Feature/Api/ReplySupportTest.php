<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Traits\TestTrait;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
    use TestTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_reply_to_support_unautheticated()
    {
        $response = $this->postJson('/replies');

        $response->assertStatus(401);
    }

    public function test_create_reply_to_support_auth_no_data()
    {
        $response = $this->postJson('/replies', [], $this->getAuthorization());

        $response->assertStatus(422);
    }

    public function test_create_reply_to_support_auth()
    {
        $support = Support::factory()->create();

        $payload = [
            'description' => 'blalslala',
            'support' => $support->id
        ];



        $response = $this->postJson('/replies', $payload, $this->getAuthorization());

        $response->assertStatus(201);
    }
}
