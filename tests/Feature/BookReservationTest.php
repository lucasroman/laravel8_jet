<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function aBookCanBeAddedToLibrary()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'The Dark Tower',
            'author' => 'Stephen King',
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function aTitleIsRequired()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'An author name',
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function testAAuthorIsRequired()
    {
        $response = $this->post('/books', [
            'title' => 'A title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }
}
