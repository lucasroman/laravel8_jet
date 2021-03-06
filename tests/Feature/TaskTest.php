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
    public function testExistUrlThatShowInputTaskForm()
    {
        $response = $this->get('/');

        $response->assertViewIs('tasks');
    }

    // Empty task don't save on database
    public function testTaskNameWillNotSavedIfThisIsEmpty()
    {
        $response = $this->post('/', ['name' => '']);
        // Check error in name attribute
        $response->assertSessionHasErrors('name');
        // Check redirect again to task form
        $response->assertRedirect('/');
    }

    // Tasks must be saved
    public function testAValidTaskCanBeSaved()
    {
        $response = $this->post('/', ['name' => 'A sample task name', ]);
        // Check that the task with text was saved on database
        $this->assertDatabaseCount('tasks', 1);

        $response->assertRedirect('/');
    }

    // Show task list
    public function testShowTaskListIfExistAtLeastOneTask()
    {
        $task = new Task(['name' => 'A sample task.']);

        $task->save();

        $response = $this->get('/');

        $response->assertSee('A sample task.');
    }

    // Delete a task
    public function testAExistingTaskCanBeDeleted()
    {
        $this->post('/', ['name' => 'A sample task name']);

        $task = Task::first();

        $this->delete('/'. $task->id);

        $this->assertDeleted('tasks', ['id' => $task->id]);
    }

}
