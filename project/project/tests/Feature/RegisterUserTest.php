<?php

describe('user registration', function () {
    it('creates a user and redirects to the ideas page', function () {
        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'Password123!',
        ]);

        $response->assertRedirect('/ideas');
        $this->assertDatabaseHas('users', [
            'email' => 'jane@example.com',
        ]);
    });
});
