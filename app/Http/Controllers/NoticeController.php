<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Http\Resources\NoticeResource;
use App\Models\Event;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "word" => "nullable|string|max:500"
        ]);

        $notices = Notice::where("title", "LIKE", "%".$request->word."%")->orderBy("important", "desc")->orderBy("created_at", "desc")->paginate(10);

        return Inertia::render("Notices/Index", [
            "notices" => NoticeResource::collection($notices),
        ]);
    }

    public function show(Notice $notice)
    {
        $notice->update(["count_view" => $notice->count_view + 1]);

        return Inertia::render("Notices/Show", [
            "notice" => NoticeResource::make($notice),
        ]);
    }
}
