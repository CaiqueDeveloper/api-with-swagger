<?php

it('the route register exists and return status code 422', function () {

    $response = $this->postJson('/api/auth/register', [])
        ->assertStatus(422);
});
todo('verify if is validation error in attempt register user sending empty form data');
todo('verify if user registered successful');

todo('the route login exists');
todo('verify if is validation error in attempt login user sending empty form data');
todo('verify if user authenticate successful');

todo('the route logout exists');
todo('verify if user logout successful');
