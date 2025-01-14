<?php

namespace Tests\Feature\User;

use App\Models\User;
use function Pest\Laravel\actingAs;

const UPDATE_USER_URI = '/api/user';

function createUser(): User
{
    return User::factory()->create([
        'email' => 'john@doe.com',
        'name' => 'Jhon Doe',
        'username' => 'jhondoe456'
    ]);
}

describe('Update user', function () {
    it('Should update user name successfully', function () {
        $requestData = ['name' => 'John Doe'];
        $user = createUser();

        $response = actingAs($user)->put(UPDATE_USER_URI, $requestData);

        $response->assertStatus(200);
        $response->json()['data']['user']['name'] = 'John Doe';
    });
});
