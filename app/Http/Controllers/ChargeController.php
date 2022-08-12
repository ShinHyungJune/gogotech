<?php

namespace App\Http\Controllers;

use App\Enums\ChargeState;
use App\Http\Resources\ChargeResource;
use App\Models\Charge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ChargeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "started_at" => "nullable|date",
            "finished_at" => "nullable|date",
        ]);

        $charges = auth()->user()->charges();

        if($request->started_at)
            $charges = $charges->where("created_at", ">=", Carbon::make($request->started_at)->startOfDay());

        if($request->finished_at)
            $charges = $charges->where("created_at", "<=", Carbon::make($request->finished_at)->endOfDay());

        $charges = $charges->latest()->paginate(30);

        return Inertia::render("Charges/Index",[
            "charges" => ChargeResource::collection($charges),
        ]);
    }

    public function create()
    {
        return Inertia::render("Charges/Create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "price" => "required|integer|min:10000",
            "name" => "required|string|max:500"
        ]);

        if(auth()->user()->charges()->where("state", ChargeState::WAIT)->count() > 0)
            return redirect()->back()->with("success", "이미 대기중인 충전요청이 있습니다. \n\n문의 : 070-7893-3469");

        $charge = auth()->user()->charges()->create($request->all());

        Http::get(config("telegram.domain").config("telegram.key")."/sendMessage", [
            "chat_id" => config("telegram.ids.charge_store"),
            "text" =>
"[포인트 충전요청]
고유번호 : {$charge->id}
충전금액 : {$charge->price}
입금자명 : {$charge->name}
요청일자 : {$charge->created_at}
=================
사용자 고유번호 : {$charge->user->id}
사용자 아이디 : {$charge->user->ids}
사용자 이름 : {$charge->user->name}
사용자 전화번호 : {$charge->user->contact}
"
        ]);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
}
