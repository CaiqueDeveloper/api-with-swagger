<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

it('the route register exists and return status code 422', function () {

    $response = $this->postJson('/api/auth/register', [])
        ->assertStatus(422);
});
it('verify if is validation error in attempt register user sending empty form data', function () {

    $this->postJson('/api/auth/register', [])
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->where('success', false)
                ->where('message', 'Validation errors')
                ->where('data.name.0', 'The name field is required.')
                ->where('data.email.0', 'The email field is required.')
                ->where('data.password.0', 'The password field is required.')
                ->etc()
        );
});
it('verify if user registered successful', function () {


    $response = $this->postJson('/api/auth/register', [
        'name' => 'User Teste',
        'email' => 'email@teste.com',
        'password' => 'password_teste',
        'password_confirmation' => 'password_teste'

    ]);

    $response->assertValid();

    $this->assertDatabaseHas(User::class, [
        'name' => 'User Teste',
        'email' => 'email@teste.com',
    ]);
});

todo('the route login exists');
todo('verify if is validation error in attempt login user sending empty form data');
todo('verify if user authenticate successful');

todo('the route logout exists');
todo('verify if user logout successful');
