<?php

use App\Models\User;

it('only allows flagged staff into the admin panel', function () {
    $regular = User::factory()->create();
    $staff = User::factory()->create(['is_admin' => true]);

    $this->actingAs($regular)->get('/admin')->assertForbidden();
    $this->actingAs($staff)->get('/admin')->assertOk();
});
