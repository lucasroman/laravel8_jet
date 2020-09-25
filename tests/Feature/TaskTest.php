<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    // Home url return tasks view
    public function testRouteHomeShowTasksView()
    {
        $response = $this->get('/');

        $response->assertViewIs('tasks');
    }

    // Make a new task
    public function testRouteCanPostANewTask()
    {
        $response = $this->post('/task');

        $response->assertOK();
    }

    // Delete a task
    public function testRouteCanDelete()
    {
        $this->markTestSkipped(
            "Require database verification I'll do it later."
        );

        $this->withoutExceptionHandling();

        $id = 1;

        $response = $this->delete('/task/{id}', [$id => 1]);

        $response->assertOK();
    }
}
