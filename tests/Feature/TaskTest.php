<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $response
        //     ->assertStatus(201)
        //     ->assertJson([
        //         'created' => true,
        //     ]);
        // ->assertExactJson([
        //         'created' => true,
        //     ]);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testGetAll()
    {
        // $response = $this->json('POST', '/user', ['name' => 'Sally'])
        $response = $this->json('GET', '/api/tasks');
        $response->dump();exit;
        $response->assertStatus(200);
    }
}
