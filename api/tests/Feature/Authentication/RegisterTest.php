<?php

namespace Tests\Feature\Authentication;

use function Pest\Laravel\assertDatabaseCount;

const REGISTER_URI = '/api/register';

describe('Register', function () {
    it('should register successfully', function () {
        $requestData = [
            'name'                  => 'John Doe',
            'email'                 => 'john@doe.com',
            'username'              => 'jhondoe456',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(REGISTER_URI, $requestData);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'User created successfully.',
            'data'    => [
                'name'     => 'John Doe',
                'email'    => 'john@doe.com',
                'username' => 'jhondoe456',
            ],
        ]);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'uuid',
                'name',
                'email',
                'username',
                'created_at',
            ],
            'access_token',
            'refresh_token',
            'expires_at',
        ]);
        assertDatabaseCount('personal_access_tokens', 1);
        assertDatabaseCount('refresh_tokens', 1);
    });

    // it ('should not register successfully', function () {});
});
