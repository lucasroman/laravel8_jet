<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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

    // 1. Check post url and view exist
    // 2. It must exist a 'create post' link in user's dashboard
    public function testItShouldExistACreatePostButton()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/dashboard');

        $response->assertSee('Create Post');
    }

    // 3. It must exist a 'index post' list in the user's dashboard
    public function testShouldExisteAnIndexPostsButton()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/dashboard');
        
        $response->assertSee('List Posts');
    }

    // 4. Check relationship between User and Posts (one-to-many)    
}
