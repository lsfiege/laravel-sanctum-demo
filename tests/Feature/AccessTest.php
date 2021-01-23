<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function logged_user_can_retrieve_their_profile_info()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'] // All token abilities
        );

        $response = $this->get('/api/me');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}
