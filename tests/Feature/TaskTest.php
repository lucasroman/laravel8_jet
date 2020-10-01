<?php

namespace Tests\Feature;

use App\Models\Task;
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
    public function testShoulNotSaveEmptyTask()
    {
        $response = $this->post('/', ['name' => '']);
        // Check that the empty task wasn't saved on database
        $this->assertDatabaseCount('tasks', 0);
        // Check redirect again to task form
        $response->assertRedirect('/');
    }

    // Tasks validated must be saved
    public function testCanSaveTaskValidated()
    {
        $response = $this->post('/', ['name' => 'A sample task name', ]);
        // Check that the task with text was saved on database
        $this->assertDatabaseCount('tasks', 1);

        $response->assertRedirect('/');
    }

    // Delete a task
    public function testRouteCanDelete()
    {
        $this->withoutExceptionHandling();

        $task = new Task(['name' => 'Task to delete', ]);

        $task->save();

        $response = $this->delete('/task/{id}', ['id' => $task->id]);

        $response->assertOK();
    }
}
