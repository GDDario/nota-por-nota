<?php

namespace Tests\Feature\User;

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\putJson;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

const UPDATE_USER_URI = '/api/user';

function createUser(): User
{
    return User::factory()->create([
        'email' => 'john@doe.com',
        'name' => 'John Doe',
        'username' => 'jhondoe456'
    ]);
}

describe('Update user', function () {
    it('Should update the name successfully', function () {
        $requestData = ['name' => 'Jhon Doe'];
        $user = createUser();

        $response = actingAs($user)->put(UPDATE_USER_URI, $requestData);

        $response->assertStatus(200);
        assertEquals('Jhon Doe', $response->json()['data']['user']['name']);
    });

    it('should update the username successfully', function() {
        $requestData = ['username' => 'johndoe123'];
        $user = createUser();

        $response = actingAs($user)->put(UPDATE_USER_URI, $requestData);

        $response->assertStatus(200);
        assertEquals('johndoe123', $response->json()['data']['user']['username']);
    });

    it('should update both the user name and username successfully', function() {
        $requestData = ['name' => 'Jhon Doe', 'username' => 'johndoe123'];
        $user = createUser();

        $response = actingAs($user)->put(UPDATE_USER_URI, $requestData);

        $response->assertStatus(200);
        assertEquals($response->json()['data']['user']['name'], 'Jhon Doe');
        assertEquals($response->json()['data']['user']['username'], 'johndoe123');
    });

    it('should not update anything if the user is not authenticated', function() {
        $requestData = ['name' => 'Jhon Doe', 'username' => 'johndoe123'];

        $response = putJson(UPDATE_USER_URI, $requestData);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthenticated.']);
    });

    it('should return an error case the name either the username is not passed on the requisition', function() {
        $requestData = [];
        $user = createUser();

        $response = actingAs($user)->putJson(UPDATE_USER_URI, $requestData);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The name field is required when username is not present. (and 1 more error)',
            'errors' => [
                'name' => ['The name field is required when username is not present.'],
                'username' => ['The username field is required when name is not present.'],
            ]
        ]);
    });
});
