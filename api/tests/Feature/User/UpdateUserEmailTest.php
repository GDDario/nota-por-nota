<?php

namespace Tests\Feature\User;

use App\Mail\NewEmailNotification;
use App\Mail\UpdateUserEmailVerification;
use App\Mail\UserEmailUpdatedNotification;
use App\Models\EmailUpdateToken;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\postJson;

const UPDATE_USER_EMAIL_BASE_URI = '/api/user/update-email';

function createUser(): User
{
    return User::factory()->create([
        'email' => 'john@doe.com'
    ]);
}

describe('Update user email', function () {
    describe('Verification link', function () {
        it('should send the verification link in the user\' email and show a success message', function () {
            Mail::fake();
            $user = createUser();

            $response = actingAs($user)->post(UPDATE_USER_EMAIL_BASE_URI . '/send-verification-link');

            $response->assertStatus(200);
            $response->assertJson([
                'message' => 'Email sent successfully. Check your inbox for further explanation.'
            ]);
            Mail::assertSent(UpdateUserEmailVerification::class, 'john@doe.com');
            assertDatabaseCount('email_update_tokens', 1);
        });

        it('should not send the verification link if there is no user logged', function () {
            Mail::fake();

            $response = postJson(UPDATE_USER_EMAIL_BASE_URI . '/send-verification-link');

            $response->assertStatus(401);
            $response->assertJson(['message' => 'Unauthenticated.']);
            Mail::assertNotSent('email_update_tokens');
        });
    });

    describe('Confirm token', function () {
        it('should successfully confirm the token', function () {
            $token = Str::random(100);
            EmailUpdateToken::factory()->create(['email' => 'john@doe.com', 'token' => $token]);
            $user = createUser();
            $requestData = ['token' => $token];

            $response = actingAs($user)->postJson(UPDATE_USER_EMAIL_BASE_URI . '/confirm-token', $requestData);

            $response->assertStatus(200);
            $response->assertJson(['message' => 'Token confirmed successfully.']);
        });

        it('should not confirm the token if the user is not authenticated', function () {
            $token = Str::random(100);
            EmailUpdateToken::factory()->create(['email' => 'john@doe.com', 'token' => $token]);
            $requestData = ['token' => $token];

            $response = postJson(UPDATE_USER_EMAIL_BASE_URI . '/confirm-token', $requestData);

            $response->assertStatus(401);
            $response->assertJson(['message' => 'Unauthenticated.']);
        });

        it('should not confirm if the token is invalid and show an error message', function () {
            $token = Str::random(100);
            $user = createUser();
            EmailUpdateToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
            ]);
            $requestBody = [
                'token' => 'Invalid token',
            ];

            $request = actingAs($user)->postJson(UPDATE_USER_EMAIL_BASE_URI . '/confirm-token', $requestBody);

            $request->assertStatus(400);
            $request->assertJson([
                'message' => 'Invalid token provided.',
                'error' => 'Invalid or already used token.',
            ]);
        });

        it('should not confirm if the token is already expired and show an error message', function () {
            $token = Str::random(100);
            $user = createUser();
            EmailUpdateToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
                'expires_at' => now(),
            ]);
            $requestBody = [
                'token' => $token,
            ];

            $request = actingAs($user)->post(UPDATE_USER_EMAIL_BASE_URI . '/confirm-token', $requestBody);

            $request->assertStatus(400);
            $request->assertJson([
                'message' => 'Invalid token provided.',
                'error' => 'Token already expired.',
            ]);
        });

        it('should not confirm if the token is not provided and show an error message', function () {
            $token = Str::random(100);
            $user = createUser();
            EmailUpdateToken::factory()->create([
                'email' => 'john@doe.com',
                'token' => $token,
            ]);
            $requestBody = [];

            $response = actingAs($user)->postJson(UPDATE_USER_EMAIL_BASE_URI . '/confirm-token', $requestBody);

            $response->assertStatus(422);
            $response->assertJson([
                'message' => 'The token field is required.',
                'errors' => [
                    'token' => [
                        'The token field is required.',
                    ],
                ],
            ]);
        });
    });

    describe('Update email', function() {
       it('should update the email successfully', function() {
           Mail::fake();
           $token = Str::random(100);
           $user = createUser();
           EmailUpdateToken::factory()->create([
               'email' => 'john@doe.com',
               'token' => $token,
           ]);
           $requestBody = [
               'token' => $token,
               'email' => 'new_john@doe.com',
               'email_confirmation' => 'new_john@doe.com'
           ];

           $response = actingAs($user)->post(UPDATE_USER_EMAIL_BASE_URI, $requestBody);

           $response->assertStatus(200);
           $response->assertJson(['message' => 'Email updated successfully!']);
           Mail::assertSent(UserEmailUpdatedNotification::class, 'john@doe.com');
           Mail::assertSent(NewEmailNotification::class, 'john@doe.com');
           assertDatabaseCount('email_update_tokens', 0);
       });
    });
});
