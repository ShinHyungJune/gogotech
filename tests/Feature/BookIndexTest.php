<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Charge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookIndexTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $admin;

    protected $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        $this->form = [
            "title" => "!23123",
        ];
    }

    /** @test */
    function 사용자는_주소록을_생성할_수_있다()
    {
        $this->post("/books", $this->form);

        $this->assertCount(1, Book::all());
    }

    /** @test */
    function 사용자는_주소록을_삭제할_수_있다()
    {
        $book = Book::factory()->create([
            "user_id" => $this->user->id
        ]);

        $this->delete("/books/".$book->id);

        $this->assertCount(0, Book::all());
    }
}
