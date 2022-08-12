<?php

namespace App\Http\Controllers;

use App\Enums\Agent;
use App\Enums\MessageType;
use App\Models\PasswordReset;
use App\Models\SMS;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FindIdsController extends Controller
{
    public function index()
    {
        return redirect()->back();
    }
    public function create()
    {
        return Inertia::render("FindIds/Create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "contact" => "required|string|max:500"
        ]);

        $request["contact"] = str_replace("-", "", $request->contact);

        $user = User::where("contact", $request->contact)->first();

        if(!$user)
            return redirect()->back()->with("error", "해당 번호로 가입된 아이디가 없습니다.");

        return Inertia::render("FindIds/Result", [
            "ids" => $user->ids
        ]);
    }
}
