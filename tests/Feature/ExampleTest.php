<?php

<<<<<<< HEAD
it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
=======
test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
});
>>>>>>> ae2dd6d (Initialize project repository)
