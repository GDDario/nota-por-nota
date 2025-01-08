<?php

use App\Mail\SendResetPasswordEmail;
use App\Models\{PasswordResetToken, User};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function Pest\Laravel\{assertDatabaseCount, post, postJson};

const RESET_PASSWORD_BASE_URI = '/api/reset-password';

beforeEach(function () {
    User::factory()->create([
        'email' => 'john@doe.com',
    ]);
});

describe('Reset password', function () {
    describe('Send email', function () {
        it('should send the confirmation email case the email exists and show a success message', function () {
            Mail::fake();
            $url         = RESET_PASSWORD_BASE_URI . "/send-email";
            $requestData = [
                'email' => 'john@doe.com',
            ];

            $response = $this->post($url, $requestData);

            $response->assertStatus(200);
            $response->assertJson([
                'message' => 'If the email exists, we will send a verification link to you continue the reset process.',
            ]);
            assertDatabaseCount('password_reset_tokens', 1);
            Mail::assertSent(SendResetPasswordEmail::class, 'john@doe.com');
        });

        it('should not send the confirmation email case the email does not exists and show the success message anyway', function () {
            Mail::fake();
            $url         = RESET_PASSWORD_BASE_URI . "/send-email";
            $requestData = [
                'email' => 'not.john@doe.com',
            ];

            $response = $this->post($url, $requestData);

            $response->assertStatus(200);
            $response->assertJson([
                'message' => 'If the email exists, we will send a verification link to you continue the reset process.',
            ]);
            assertDatabaseCount('password_reset_tokens', 0);
            Mail::assertNotSent(SendResetPasswordEmail::class, 'john@doe.com');
        });

        it('should show an error message case the email is not provided', function () {
            $url         = RESET_PASSWORD_BASE_URI . "/send-email";
            $requestData = [
            ];

            $response = $this->postJson($url, $requestData);

            $response->assertStatus(422);
            $response->assertJson([
                'message' => 'The email field is required.',
                'errors'  => [
                    'email' => ['The email field is required.'],
                ],
            ]);
        });

        it('should show an error message case the email provided is an invalid one', function () {
            $url         = RESET_PASSWORD_BASE_URI . "/send-email";
            $requestData = [
                'email' => 'invalid email',
            ];

            $response = $this->postJson($url, $requestData);

            $response->assertStatus(422);
            $response->assertJson([
                'message' => 'The email field must be a valid email address.',
                'errors'  => [
                    'email' => ['The email field must be a valid email address.'],
                ],
            ]);
        });
    });

    describe('Confirm token', function () {
        it('should confirm the token provided', function () {
            $token = Str::random(100);
            PasswordResetToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
            ]);
            $requestBody = [
                'token' => $token,
            ];

            $request = post(RESET_PASSWORD_BASE_URI . '/confirm-token', $requestBody);

            $request->assertStatus(200);
            $request->assertJson(['message' => 'Token confirmed successfully.']);
        });

        it('should not confirm if the token is invalid and show an error message', function () {
            $token = Str::random(100);
            PasswordResetToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
            ]);
            $requestBody = [
                'token' => 'Invalid token',
            ];

            $request = post(RESET_PASSWORD_BASE_URI . '/confirm-token', $requestBody);

            $request->assertStatus(400);
            $request->assertJson([
                'message' => 'Invalid token provided.',
                'error'   => 'Invalid or already used token.',
            ]);
        });

        it('should not confirm if the token is already expired and show an error message', function () {
            $token = Str::random(100);
            PasswordResetToken::factory()->create([
                'email'      => 'john@doe.com',
                'token'      => $token,
                'expires_at' => now(),
            ]);
            $requestBody = [
                'token' => $token,
            ];

            $request = post(RESET_PASSWORD_BASE_URI . '/confirm-token', $requestBody);

            $request->assertStatus(400);
            $request->assertJson([
                'message' => 'Invalid token provided.',
                'error'   => 'Token already expired.',
            ]);
        });

        it('should not confirm if the token is not provided and show an error message', function () {
            $token = Str::random(100);
            PasswordResetToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
            ]);
            $requestBody = [
            ];

            $request = postJson(RESET_PASSWORD_BASE_URI . '/confirm-token', $requestBody);

            $request->assertStatus(422);
            $request->assertJson([
                'message' => 'The token field is required.',
                'errors'  => [
                    'token' => [
                        'The token field is required.',
                    ],
                ],
            ]);
        });
    });

    describe('Reset password', function() {
        it('should reset the password and delete the token', function() {
            Mail::fake();
            User::factory()->create(['email' => 'john@doe.com']);
            $token = Str::random(100);
            PasswordResetToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
            ]);
            $requestBody = [
                'token' => $token,
                'password' => 'password',
                'password_confirmation' => 'password'
            ];

            $response = post(RESET_PASSWORD_BASE_URI . '/reset-password', $requestBody);

            $response->assertStatus(200);
            $response->assertJson(['message' => 'Password reseted successfully!']);
            assertDatabaseCount('password_reset_tokens', 0);
            Mail::assertNotSent(PasswordResetedEmail::class, 'john@doe.com');
        });
    });
});
