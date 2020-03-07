<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Tasks\Task;

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
        $response = $this->json('GET', '/api/tasks');
        $response->assertStatus(200)
            ->assertJson([
                'data' => array(),
            ]);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/api/tasks/1');
        $response->assertStatus(200);
    }
    public function testPost() {
        $data = [
            'title' =>  $this->faker->sentence,
            'note' => $this->faker->paragraph,
            'is_completed' => 0,
            'tags' => 'Important',
        ];

        $this->json('POST', '/api/tasks', $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
    public function testUpdate() {

        $task = factory(Task::class)->create();
        $data = [
            'title' => $this->faker->sentence,
            'note' => $this->faker->paragraph
        ];
        $this->json('PUT', "/api/tasks/".$task->id, $data)  
            ->assertStatus(200)
            ->assertJson($data);
    }
    public function testDelete() {

        $task = factory(Task::class)->create();
        $data = [
            'title' => $this->faker->sentence,
            'note' => $this->faker->paragraph
        ];
        $this->json('DELETE', "/api/tasks/".$task->id, $data)  
            ->assertStatus(204);
    }
}
