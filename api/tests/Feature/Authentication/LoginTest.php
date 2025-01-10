<?php

namespace Tests\Feature\Authentication;

use App\Models\User;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseEmpty, postJson};

const LOGIN_URI = '/api/login';

beforeEach(function () {
    User::factory()->create([
        'email' => 'john@doe.com',
    ]);
});

describe('Login', function () {
    it('should login successfully', function () {
        $requestData = [
            'email'    => 'john@doe.com',
            'password' => 'password',
        ];

        $response = $this->post(LOGIN_URI, $requestData);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'user' => [
                    'email' => 'john@doe.com',
                ],
            ],
        ]);
        $response->assertJsonStructure([
            'data' => [
                'user' => [
                    'uuid',
                    'name',
                    'email',
                    'username',
                    'picture',
                    'created_at',
                    'updated_at',
                ],
                'access_token',
                'refresh_token',
                'expires_at',
            ],
        ]);
        assertDatabaseCount('personal_access_tokens', 1);
        assertDatabaseCount('refresh_tokens', 1);
    });

    it('should not login successfully with no email provided', function () {
        $requestData = [
            'password' => 'password',
        ];

        $response = postJson(LOGIN_URI, $requestData);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The email field is required.',
            'errors'  => [
                'email' => [
                    'The email field is required.',
                ],
            ],
        ]);
        assertDatabaseEmpty('personal_access_tokens');
        assertDatabaseEmpty('refresh_tokens');
    });

    it('should not login successfully with invalid email', function () {
        $requestData = [
            'email'    => 'not@johndoe.com',
            'password' => 'password',
        ];

        $response = postJson(LOGIN_URI, $requestData);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The selected email is invalid.',
            'errors'  => [
                'email' => [
                    'The selected email is invalid.',
                ],
            ],
        ]);
        assertDatabaseEmpty('personal_access_tokens');
        assertDatabaseEmpty('refresh_tokens');
    });

    it('should not login successfully with no password provided', function () {
        $requestData = [
            'email' => 'john@doe.com',
        ];

        $response = postJson(LOGIN_URI, $requestData);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The password field is required.',
            'errors'  => [
                'password' => [
                    'The password field is required.',
                ],
            ],
        ]);
        assertDatabaseEmpty('personal_access_tokens');
        assertDatabaseEmpty('refresh_tokens');
    });

    it('should not login successfully with invalid password and show generic error', function () {
        $requestData = [
            'email'    => 'john@doe.com',
            'password' => 'invalid_passwordy',
        ];

        $response = postJson(LOGIN_URI, $requestData);

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Invalid credentials provided.']);
        assertDatabaseEmpty('personal_access_tokens');
        assertDatabaseEmpty('refresh_tokens');
    });
});
