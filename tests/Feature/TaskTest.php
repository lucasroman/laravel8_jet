<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    // Home url return tasks view
    public function testRouteHomeShowTasksView()
    {
        $response = $this->get('/');

        $response->assertViewIs('tasks');
    }

    // Empty task don't save on database
    public function testRedirectTaskToFormAgainIfEmpty()
    {
        $response = $this->post('/', ['name' => '']);

        $this->assertDatabaseCount('tasks', 0);

        $response->assertRedirect('/');
    }

    // Tasks with test can be saved
    public function testCanSaveTaskWithText()
    {
        $response = $this->post('/', ['name' => 'A sample task name', ]);

        $this->assertDatabaseCount('tasks', 1);
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
