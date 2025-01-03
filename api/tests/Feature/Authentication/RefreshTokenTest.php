<?php

use App\Models\User;
use function Pest\Laravel\{assertDatabaseCount};

const LOGIN_URI = '/api/login';
const REFRESH_TOKEN_URI = '/api/refresh-token';

describe('Refresh token', function () {
    it('should refresh the access_token', function () {
        $user = User::factory()->create([
            'email' => 'jhon@doe.com',
        ]);
        $loginRequestData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $loginResponse = $this->post(LOGIN_URI, $loginRequestData);
        $refreshToken = $loginResponse->json()['data']['refresh_token'];
        $refreshTokenRequestData = ['refresh_token' => $refreshToken];

        $refreshTokenResponse = $this->post(REFRESH_TOKEN_URI, $refreshTokenRequestData);

        $refreshTokenResponse->assertStatus(200);
        $refreshTokenResponse->assertJsonStructure([
            'data' => [
                'access_token',
                'refresh_token',
                'expires_at',
            ],
        ]);
        assertDatabaseCount('personal_access_tokens', 2);
        assertDatabaseCount('refresh_tokens', 2);
    });

    it('should not refresh the access_token if the refresh_token is invalid', function () {
        $refreshTokenRequestData = ['refresh_token' => 'invalid-refresh-token'];

        $refreshTokenResponse = $this->postJson(REFRESH_TOKEN_URI, $refreshTokenRequestData);
        $refreshTokenResponse->assertStatus(422);
        $refreshTokenResponse->assertJson([
            'message' => 'The selected refresh token is invalid.',
            'errors' => [
                'refresh_token' => ['The selected refresh token is invalid.'],
            ],
        ]);
    });

    it('should not refresh the access_token if the refresh_token is missing', function () {
        $refreshTokenRequestData = [];

        $refreshTokenResponse = $this->postJson(REFRESH_TOKEN_URI, $refreshTokenRequestData);
        $refreshTokenResponse->assertStatus(422);
        $refreshTokenResponse->assertJson([
            'message' => 'The refresh token field is required.',
            'errors' => [
                'refresh_token' => ['The refresh token field is required.'],
            ],
        ]);
    });
});
