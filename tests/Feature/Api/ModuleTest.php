<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Traits\TestTrait;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use TestTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_modules_unnathenticate()
    {
        $response = $this->getJson('/courses/2545/modules');

        $response->assertStatus(404);
    }

    public function test_get_modules_course_not_found()
    {
        $response = $this->getJson('/courses/2545/module', $this->getAuthorization());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test_get_modules_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}/module", $this->getAuthorization());

        $response->assertStatus(200);
    }

    public function test_get_modules_course_total()
    {
        $course = Course::factory()->create();

        $modules = Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->id}/module", $this->getAuthorization());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
}
