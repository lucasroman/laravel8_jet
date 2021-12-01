<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // It must exist a create post form 
    public function testItShouldExistAFormToCreateAPost()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/posts/create');

        $response->assertViewIs('posts.create');
    }

    // It can create a post with valid data
    public function testItShouldCreateAPostWithValidData()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user);

        
    }
}
