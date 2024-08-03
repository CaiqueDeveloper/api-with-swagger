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
test('verifique se somente usuários autenticados podem editar uma tarefa', function () {

    $this->putJson('/api/todos')
        ->assertUnauthorized();
});
test('verifique se ao tentar editar uma tarefa com campos vazios está sendo retornado erro de validação', function () {

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

    $this->putJson(
        '/api/todos',
        [
            'id' => 1,
            'name' => 'Todo Updated'
        ]
    )
        ->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->hasAny(['meta', 'data'])
                ->etc()
        );
});
test('verifique se somente usuários autenticados podem deletar uma tarefa', function () {

    $this->deleteJson('/api/todos/1')
        ->assertUnauthorized();
});
test('verificando se ao tentar deletar uma todo sem passar o ID um erro é retornado', function () {

    Sanctum::actingAs(User::factory()->create());

    $this->json('delete', '/api/todos')
        ->assertStatus(405);
});
test('verificando se ao tentar deletar uma todo que não existe um alerta está sendo retornado', function () {

    Sanctum::actingAs(User::factory()->create());

    $this->json('delete', '/api/todos/10')
        ->assertStatus(404)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->hasAny(['meta', 'data'])
                ->where('meta.code', 404)
                ->where('meta.status', 'fails')
                ->where('meta.message', 'Todo not found!')
                ->etc()
        );
});
test('verificando uma tarefa foi deletada com sucesso', function () {

    Sanctum::actingAs(User::factory()->create());

    $this->json('delete', '/api/todos/1')
        ->assertJson(

            fn (AssertableJson $json) =>

            $json->hasAny(['meta', 'data'])
                ->where('meta.code', 200)
                ->where('meta.status', 'success')
                ->where('meta.message', 'Todo deleted successfully!')
                ->etc()
        );
});
