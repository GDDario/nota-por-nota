<?php

use App\Models\User;
use function Pest\Laravel\{assertDatabaseCount};

const RESET_PASSWORD_BASE_URI = '/api/reset-password';

beforeEach(functioN () {
    User::factory()->create([
        'email' => 'jhon@doe.com',
    ]);
});

describe('Reset password', function () {
    it('should send the confirmation email case the email exists and show a success message', function () {
        $url = RESET_PASSWORD_BASE_URI . "/send-email";
        $requestData = [
            'email' => 'jhon@doe.com'
        ];

        $response = $this->post($url, $requestData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'If the email exists, we will send a verification link to you continue the reset process.'
        ]);
        assertDatabaseCount('password_reset_tokens', 1);
    });

    it('should not send the confirmation email case the email does not exists and show the success message anyway', function () {
        $url = RESET_PASSWORD_BASE_URI . "/send-email";
        $requestData = [
            'email' => 'not.jhon@doe.com'
        ];

        $response = $this->post($url, $requestData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'If the email exists, we will send a verification link to you continue the reset process.'
        ]);
        assertDatabaseCount('password_reset_tokens', 0);
    });

    it('should show an error message case the email is not provided', function () {
        $url = RESET_PASSWORD_BASE_URI . "/send-email";
        $requestData = [
        ];

        $response = $this->postJson($url, $requestData);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The email field is required.',
            'errors' => [
                'email' => ['The email field is required.']
            ]
        ]);
    });

    it('should show an error message case the email provided is an invalid one', function () {
        $url = RESET_PASSWORD_BASE_URI . "/send-email";
        $requestData = [
            'email' => 'invalid email'
        ];

        $response = $this->postJson($url, $requestData);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The email field must be a valid email address.',
            'errors' => [
                'email' => ['The email field must be a valid email address.']
            ]
        ]);
    });
});
