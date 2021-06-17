<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Storage;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_redirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_health()
    {
      $response = $this->get('api/health');

      $response->assertStatus(200);
    }
}
