<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_validation_error_without_credential()
    {
        $response = $this->post('/api/v1/auth/login');

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
    }

    /**
     * @return void
     */
    public function test_return_error_with_invalid_credential()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'usera@app.com',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
    }

    /**
     * @return void
     */
    public function test_return_token_with_valid_credential()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'usera@app.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'token_type',
                'token',
                'user'
            ]
        ]);
    }
}
