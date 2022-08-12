<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ContactsImport implements ToModel, WithChunkReading
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $contact = $row[1];

        if(substr($contact, 0, 2) == "10")
            $contact = "0".$contact;

        return Contact::updateOrCreate([
            "book_id" => $this->book->id,
            "contact" => $contact,
        ],[
            "book_id" => $this->book->id,
            "name" => $row[0],
            "contact" => $contact
        ]);
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
