<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\ContactResource;
use App\Imports\ContactsImport;
use App\Models\Book;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "book_id" => "required|integer"
        ]);

        $book = Book::find($request->book_id);

        if(!$book)
            return redirect()->back()->with("error" , "존재하지 않는 주소록입니다.");

        if($book->user_id != auth()->id())
            return redirect()->back()->with("error" , "자신의 주소록만 조회할 수 있습니다.");

        $contacts = $book->contacts()->latest()->paginate(500);

        return Inertia::render("Contacts/Index", [
            "contacts" => ContactResource::collection($contacts),
            "book" => BookResource::make($book)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "book_id" => "required|integer",
            "name" => "required|string|max:500",
            "contact" => "required|string|max:500"
        ]);

        $book = Book::find($request->book_id);

        $request["contact"] = str_replace("-", "", $request->contact);

        if(!$book)
            return redirect()->back()->with("error" , "존재하지 않는 주소록입니다.");

        if($book->user_id != auth()->id())
            return redirect()->back()->with("error" , "자신의 주소록만 조회할 수 있습니다.");

        if($book->contacts()->count() >= 50000)
            return redirect()->back()->with("error" , "주소록당 최대 5만개의 연락처만 등록할 수 있습니다.");

        $prevContact = $book->contacts()->where("contact", $request->contact)->first();

        if(!$prevContact)
            $book->contacts()->updateOrCreate([
                "book_id" => $book->id,
                "contact" => $request->contact
            ],$request->all());

        return redirect()->back()->with("success" , "성공적으로 처리되었습니다.");
    }

    public function destroy(Contact $contact)
    {
        if($contact->book->user_id != auth()->id())
            return redirect()->back()->with("error" , "자신의 주소록 연락처만 삭제할 수 있습니다.");

        $contact->delete();

        return redirect()->back()->with("success" , "성공적으로 처리되었습니다.");
    }

    public function upload(Request $request)
    {
        $request->validate([
            "file" => "required|file|max:50000",
            "book_id" => "required|integer"
        ]);

        $book = Book::find($request->book_id);

        if(!$book)
            return redirect()->back()->with("error" , "존재하지 않는 주소록입니다.");

        if($book->user_id != auth()->id())
            return redirect()->back()->with("error" , "자신의 주소록만 조회할 수 있습니다.");

        Excel::import(new ContactsImport($book), $request->file);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
}
