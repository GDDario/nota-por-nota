<?php

namespace Tests\Feature\Authentication;

const REGISTER_URI = '/api/user';

it('should register successfully', function () {
    $requestData = [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'username' => 'jhondoe456',
        'password' => 'password',
        'password_confirmation' => 'password'
    ];

    $response = $this->post(REGISTER_URI, $requestData);

    $response->assertStatus(201);
    $response->assertJson([
        'message' => 'User created successfully.',
        'data' => [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'username' => 'jhondoe456'
        ]
    ]);
    $response->assertJsonStructure([
        'data' => [
            'uuid',
            'name',
            'email',
            'username',
            'created_at'
        ],
    ]);
});
