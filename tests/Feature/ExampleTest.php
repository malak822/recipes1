<?php

it('redirects home to recipes index', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('recipes.index'));
});
