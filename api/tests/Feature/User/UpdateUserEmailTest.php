<?php

namespace Tests\Feature\User;

use App\Mail\UpdateUserEmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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
    });
});
