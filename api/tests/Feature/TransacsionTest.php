<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransacsionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_error_without_token()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/transfer/send');

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
    public function test_return_error_with_invalid_token()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 123',
        ])->post('/api/v1/transfer/send');

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
    public function test_return_error_without_required_field()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'usera@app.com',
            'password' => '12345678'
        ]);
        $token = json_decode($response->getContent())->data->token;

        $response2 = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/transfer/send');

        $response2->assertStatus(422);
        $response2->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
    }

    /**
     * @return void
     */
    public function test_return_error_when_send_money_to_own_account()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'usera@app.com',
            'password' => '12345678'
        ]);
        $token = json_decode($response->getContent())->data->token;

        $response2 = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/transfer/send', [
            'account_no' => 'usera@app.com',
            'amount' => 10
        ]);

        $response2->assertStatus(422);
        $response2->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
    }

    /**
     * @return void
     */
    public function test_return_success_when_successfully_transfer()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'usera@app.com',
            'password' => '12345678'
        ]);
        $token = json_decode($response->getContent())->data->token;

        $response2 = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/transfer/send', [
            'account_no' => 'userb@app.com',
            'amount' => 10
        ]);

        $response2->assertStatus(200);
        $response2->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
    }
}
