<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::make();
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
        $post1 = Post::make([
            'title' => 'Post test title',
            'text' => 'Text for post example test',
            'owner' => $this->user
        ]);

        $posts = $this->user->posts;
    }   
}
