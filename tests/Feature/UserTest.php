<?php

it('verique se ao tentar atulizar os dados de usuário não logao um erro de Unauthorized é retornado', function () {

    $this->putJson('/api/user', [])
        ->assertUnauthorized();
});
todo('verifique se o usuário auteticado consguiu atulizar as infromações dele com sucesso');
todo('verique se ao tentar deletar os dados de usuário não estando logado um error de validação é retornado');
todo('verifique se o usuário  foi deletado com seucesso');
