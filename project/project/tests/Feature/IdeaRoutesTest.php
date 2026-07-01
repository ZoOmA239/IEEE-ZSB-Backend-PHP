<?php

describe('idea routes', function () {
    it('renders the ideas index page', function () {
        $response = $this->get('/ideas');

        $response->assertStatus(200);
    });
});
