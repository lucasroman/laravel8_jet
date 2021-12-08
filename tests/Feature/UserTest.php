<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    // use RefreshDatabase; // Too slow but necessary to recreate database
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // Require follow conventions to work sentence below
        $this->user = User::factory()
                            ->hasPosts(2)
                            ->create();
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
        // Posts table have two posts
        $this->assertDatabaseCount('posts', 2);

        // The posts belongs to one user
        $this->assertCount(2, $this->user->posts);

        // Exist at least one relationship between user and post
        $this->assertDatabaseHas('posts', ['user_id' => $this->user->id]);

    }   
}
