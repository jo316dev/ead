<?php

namespace Tests\Feature\Api\Traits;

use App\Models\User;

trait TestTrait
{
    private function createUser()
    {
        return User::factory()->create();
    }

    private function createTokenUser()
    {
        $user = User::factory()->create();

        $token = $user->createToken('teste')->plainTextToken;

        return $token;
    }


    private function getAuthorization()
    {
        return ['Authorization' => "Bearer {$this->createTokenUser()}"];
    }
}
