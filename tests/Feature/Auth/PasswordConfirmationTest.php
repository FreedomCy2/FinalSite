<?php

use App\Models\User;

<<<<<<< HEAD
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

=======
>>>>>>> ae2dd6d (Initialize project repository)
test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('password.confirm'));

    $response->assertStatus(200);
});