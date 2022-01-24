<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Traits\TestTrait;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use TestTrait;


    public function test_unnathenticated_course()
    {

        $token = $this->createTokenUser();

        $response = $this->getJson('/courses');

        $response->assertStatus(401);
    }

    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses', $this->getAuthorization());

        $response->assertStatus(200);
    }

    public function test_get_courses()
    {
        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses', $this->getAuthorization());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_get_single_course_unnatheticate()
    {
        $response = $this->getJson('/courses/fake_id');

        $response->assertStatus(401);
    }

    public function test_get_single_course_not_found()
    {
        $response = $this->getJson('/courses/fake_id', $this->getAuthorization());

        $response->assertStatus(404);
    }


    public function test_get_single_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}", $this->getAuthorization());

        $response->assertStatus(200);
    }
}
