<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Charge;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactIndexTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $book;

    protected $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        $this->book = Book::factory()->create([
            "user_id" => $this->user->id
        ]);

        $this->form = [
            "book_id" => $this->book->id,
            "name" => "!23123",
            "contact" => "1231232",
        ];
    }

    /** @test */
    function 사용자는_연락처_목록을_조회할_수_있다()
    {
        $contacts = Contact::factory()->count(12)->create([
            "book_id" => $this->book->id,
        ]);

        $this->json("get","/contacts",[
            "book_id" => $this->book->id
        ])->assertInertia(function($page) use($contacts){
            $items = $page->toArray()["props"]["contacts"]["data"];

            $this->assertCount(count($contacts), $items);
        });
    }

    /** @test */
    function 사용자는_연락처를_생성할_수_있다()
    {
        $this->post("/contacts", $this->form);

        $this->assertCount(1, Contact::all());
    }

    /** @test */
    function 사용자는_연락처를_삭제할_수_있다()
    {
        $contact = Contact::factory()->create([
            "book_id" => $this->book->id
        ]);

        $this->delete("/contacts/".$contact->id);

        $this->assertCount(0, Contact::all());
    }
}
