<?php

test('verifique se somente usuários autenticados podem cadastrar uma tarefa', function () {

    $this->postJson('/api/todos')
        ->assertUnauthorized();
});
