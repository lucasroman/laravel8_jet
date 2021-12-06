<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; // Too slow

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    // It must exist a 'create post' link in user's dashboard
    public function testItShouldExistACreatePostButton()
    {
        $response = $this->actingAs($this->user)
                         ->get('/dashboard');

        $response->assertSee('Create Post');
    }

    // It must exist a 'index post' list in the user's dashboard
    public function testShouldExisteAnIndexPostsButton()
    {
        $response = $this->actingAs($this->user)
                         ->get('/dashboard');
        
        $response->assertSee('List Posts');
    }

    // Check relationship between User and Posts (one-to-many) 
    public function testOneUserCanHaveManyPosts()
    {
        $post = Post::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertCount(1, $this->user->posts);
    }   
}
