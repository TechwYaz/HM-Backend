<?php

test('the root endpoint is not available', function () {
    $response = $this->get('/');

    $response->assertNotFound();
});
