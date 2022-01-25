<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Traits\TestTrait;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use TestTrait;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_lessons_unnathenticate()
    {
        $response = $this->getJson('/lesson/5475854');

        $response->assertStatus(401);
    }

    public function test_get_lessons_not_found()
    {
        $response = $this->getJson('/lesson/554474', $this->getAuthorization());

        $response->assertStatus(404);
    }

    public function get_all_lessons_by_module()
    {
        $module = Module::factory()->create();

        Lesson::factory()->count(200)->create([
            'module_id' => $module->id
        ]);

        $reponse = $this->getJson("/modules/{$module->id}/lessons", $this->getAuthorization());

        $reponse->assertStatus(200)->assertJsonCount(200, 'data');
    }
}
