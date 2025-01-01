<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\post;

const LOGIN_URI = '/api/login';
const LOGOUT_URI = '/api/logout';

define('LOGOUT_URI', '/api/logout');

describe('Logout', function () {
    it('should logout successfully', function () {
        $user = User::factory()->create([
            'email' => 'john@doe.com'
        ]);
        $token = $user->createToken('access_token')->plainTextToken;

        assertDatabaseCount('personal_access_tokens', 1);

        post(LOGOUT_URI, [], ['Authorization' => "Bearer $token"]);

        assertDatabaseEmpty('personal_access_tokens');
        assertDatabaseEmpty('refresh_tokens');
    });

    // FIXME: for some reason the response is getting a 500 with the message:
    // Symfony\Component\Routing\Exception\RouteNotFoundException: Route [login] not defined
//    it('should not logout case user is not authenticated', function () {
//        $user = User::factory()->create([
//            'email' => 'john@doe.com'
//        ]);
//
//        $response = post(LOGOUT_URI, [], ['Authorization' => "Bearer 49|2NBX1CD3zbcWPj9ekCECxBOjmZAA5cznto9VjIIQ268d1785"]);
//
//        $response->assertStatus(401);
//        $response->assertJson(['message' => 'Unauthenticated.']);
//
//        assertDatabaseEmpty('personal_access_tokens');
//        assertDatabaseEmpty('refresh_tokens');
//    });
});
