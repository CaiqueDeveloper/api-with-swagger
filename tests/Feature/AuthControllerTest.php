<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

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

it('the route login exists and return status code 422', function () {

    $response = $this->postJson('/api/auth/login', [])
        ->assertStatus(422);
});
it('verify if is validation error in attempt login user sending empty form data', function () {

    $this->postJson('/api/auth/login', [])
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->where('success', false)
                ->where('message', 'Validation errors')
                ->where('data.email.0', 'The email field is required.')
                ->where('data.password.0', 'The password field is required.')
                ->etc()
        );
});
it('verify if user authenticate successful', function () {

    $response = $this->postJson('/api/auth/login', [
        'email' => 'email@teste.com',
        'password' => 'password_teste',
    ]);

    $response->assertValid();

    $response->assertJson(
        fn (AssertableJson $json) =>
        $json->hasAll(['meta', 'data', 'access_token'])
            ->where('meta.code', 202)
            ->where('meta.message', 'Login success.')
            ->where('data.user.email', 'email@teste.com')
            ->etc()
    );
});

it('the route logout exists and return error unauthorized', function () {

    $response = $this->postJson('/api/auth/logout')
        ->assertUnauthorized();
});
it('verify if user logout successful', function () {

    Sanctum::actingAs(
        User::factory()->create()
    );
    $response = $this->postJson('/api/auth/logout')
        ->assertStatus(202);

    $response->assertJson(
        fn (AssertableJson $json) =>

        $json->hasAny(['meta', 'data'])
            ->where('meta.code', 202)
            ->where('meta.status', 'success')
            ->where('meta.message', 'Successfully logged out')
            ->etc()
    );
});
