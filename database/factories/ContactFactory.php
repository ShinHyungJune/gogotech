<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $book = Book::first() ? Book::first() : Book::factory()->create();

        return [
            "book_id" => $book->id,
            "name" => $this->faker->name,
            "contact" => "010-0000-0000",
            "memo" => "기타"
        ];
    }
}
