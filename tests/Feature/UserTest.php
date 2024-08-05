<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

it('verique se ao tentar atulizar os dados de usuário não logao um erro de Unauthorized é retornado', function () {

    $this->putJson('/api/user', [])
        ->assertUnauthorized();
});
it('verifique se o usuário auteticado consguiu atulizar as informações dele com sucesso', function () {

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->putJson("/api/user", [
        'id' => $user->id,
        'name' => 'User Name Updated',
        'email' => $user->email
    ])
        ->assertStatus(202)
        ->assertJson(
            fn (AssertableJson $json) =>

            $json->hasAny(['meta', 'data', 'access_token'])
                ->where('meta.code', 202)
                ->where('meta.status', 'success')
                ->where('meta.message', 'User updated successfully!')
        );
});
it('verique se ao tentar deletar um usuario não estando logado um erro de Unauthorized é retornado', function () {

    $this->deleteJson('/api/user', [])
        ->assertUnauthorized();
});
todo('verifique se o usuário  foi deletado com seucesso');
