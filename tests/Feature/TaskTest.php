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
    public function testRouteCanGetHome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRouteCanPostANewTask()
    {
        $response = $this->post('/task');

        $response->assertOK();
    }

    public function testRouteCanDelete()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $response = $this->delete('/task/{id}', [$id => 1]);

        $response->assertOK();
    }
}
