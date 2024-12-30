<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\be;

const LOGIN_URI = '/api/login';

beforeEach(function () {
    User::factory()->create([
        'email' => 'john@doe.com'
    ]);
});

describe('Login', function () {
    it('should login successfully', function () {
        $requestData = [
            'email' => 'john@doe.com',
            'password' => 'password'
        ];

        $response = $this->post(LOGIN_URI, $requestData);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'email' => 'john@doe.com',
            ],
        ]);
        $response->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'email',
                'username',
                'created_at',
                'updated_at'
            ],
            'access_token',
            'refresh_token',
            'expires_at'
        ]);
        assertDatabaseCount('personal_access_tokens', 1);
        assertDatabaseCount('refresh_tokens', 1);
    });
});
