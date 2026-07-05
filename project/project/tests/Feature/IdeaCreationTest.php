<?php

use App\Models\User;

describe('idea creation', function () {
    it('stores an idea for the authenticated user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/ideas', [
            'description' => 'A new idea',
        ]);

        $response->assertRedirect('/ideas');
        $this->assertDatabaseHas('ideas', [
            'description' => 'A new idea',
            'user_id' => $user->id,
        ]);
    });
});
