<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    /** @test */
    public function aBookCanBeAddedToLibrary()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/book', [
            'title' => 'The Dark Tower',
            'author' => 'Stephen King',
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }
}
