<?php

namespace App\Http\Controllers;

use App\Http\Resources\QnaResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QnaController extends Controller
{
    public function index()
    {
        $qnas = auth()->user()->qnas()->orderBy("created_at", "desc")->paginate(5);

        return Inertia::render("Qnas/Index",[
            "qnas" => QnaResource::collection($qnas)
        ]);
    }

    public function create()
    {
        return Inertia::render("Qnas/Create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "question" => "required|string|max:50000"
        ]);

        auth()->user()->qnas()->create([
            "question" => $request->question
        ]);

        return redirect("/qnas")->with("success", "성공적으로 처리되었습니다.");
    }
}
