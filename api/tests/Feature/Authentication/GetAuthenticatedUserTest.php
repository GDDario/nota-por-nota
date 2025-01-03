<?php

namespace Tests\Feature\Authentication;

use App\Models\User;

use function Pest\Laravel\getJson;

const GET_AUTHENTICATED_USER_URI = '/api/auth_user';

describe('Get authenticated user', function () {
    it('should bring the authenticated user data correctly', function () {
        $user = User::factory()->create([
            'uuid'     => '5a9ce7ef-2691-481e-9cd1-7e6205437c1e',
            'name'     => 'John Doe',
            'email'    => 'john@doe.com',
            'username' => 'jhondoe456',
        ]);

        $response = $this->actingAs($user)->get(GET_AUTHENTICATED_USER_URI);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'uuid'     => '5a9ce7ef-2691-481e-9cd1-7e6205437c1e',
                'name'     => 'John Doe',
                'email'    => 'john@doe.com',
                'username' => 'jhondoe456',
            ],
        ]);
        $response->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'email',
                'username',
                'created_at',
                'updated_at',
            ],
        ]);
    });

    it('should not bring the authenticated user information if the user is not authenticated', function () {
        User::factory()->create([
            'email' => 'john@doe.com',
        ]);

        $response = getJson(GET_AUTHENTICATED_USER_URI);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthenticated.']);
    });
});
