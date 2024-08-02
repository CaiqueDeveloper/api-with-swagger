<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

test('verifique se somente usuários autenticados podem cadastrar uma tarefa', function () {

    $this->postJson('/api/todos')
        ->assertUnauthorized();
});
test('verifique se ao tentar cadastrar uma tarefa com campos vazios está sendo retornado erro de validação', function () {

    Sanctum::actingAs(User::factory()->create());

    $response = $this->postJson('/api/todos', ['name' => ''])
        ->assertStatus(422)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->where('success', false)
                ->where('message', 'Validation errors')
                ->where('data.name.0', 'The name field is required.')
                ->etc()
        );
});
test('verifique se somente usuários autenticados podem casdastrar uma tarefas', function () {

    Sanctum::actingAs(User::factory()->create());

    $this->postJson('/api/todos', ['name' => 'Todo Test'])
        ->assertStatus(201)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->hasAny(['meta', 'data'])
                ->where('meta.code', 201)
                ->where('meta.status', 'success')
                ->where('meta.message', 'Todo created successfully!')
                ->etc()
        );
});
test('verifique se somente usuários autenticados podem ver todas as tarefas cadastradas', function () {

    $this->getJson('/api/todos')
        ->assertUnauthorized();
});
test('verifique se está retornando as tarefas cadastrada ou um array vazio', function () {

    Sanctum::actingAs(User::factory()->create());

    $this->getJson('/api/todos')
        ->assertStatus(201)
        ->assertJson(

            fn (AssertableJson $json) =>

            $json->hasAny(['meta', 'data'])
                ->where('meta.code', 201)
                ->where('meta.status', 'success')
                ->where('meta.message', 'List all todos successfully!')
                ->etc()
        );
});
test('verifique se somente usuários autenticados podem update uma tarefa', function () {

    $this->putJson('/api/todos')
        ->assertUnauthorized();
});
