<?php

namespace Tests\Feature\User;

use App\Mail\UpdateUserEmailVerification;
use App\Models\EmailUpdateToken;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\post;
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

        it('should not send the verification link case the user is not logged do not exist', function () {
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
    });
});
