<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Imports\ContactsImport;
use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = auth()->user()->books()->where("public", true)->latest()->paginate(30);

        return Inertia::render("Books/Index", [
           "books" => BookResource::collection($books)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:500"
        ]);

        $book = auth()->user()->books()->create($request->all());

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    public function destroy(Book $book)
    {
        if($book->user_id != auth()->id())
            return redirect()->back()->with("error" , "자신의 주소록만 삭제할 수 있습니다.");

        $book->delete();

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }


}
