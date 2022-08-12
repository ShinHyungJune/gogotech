<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            "letter_id" => "required|integer"
        ]);

        $letter = Letter::find($request->letter_id);

        if(!$letter)
            return redirect()->back()->with("error", "존재하지 않는 발송내역입니다.");

        if($letter->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 발송내역만 환불 받을 수 있습니다.");

        if($letter->refunded)
            return redirect()->back()->with("error", "이미 환불이 완료된 발송내역입니다.");

        if($letter->count - $letter->count_success - $letter->count_fail > 0)
            return redirect()->back()->with("error", "대기중인 발송건수가 있는 발송내역은 모든 발송이 완료된 후 환불신청이 가능합니다.");

        if($letter->count_fail <= 0)
            return redirect()->back()->with("error", "환불할 발송건수가 없습니다.");

        $refundPrice = $letter->price * $letter->count_fail;

        auth()->user()->update([
            "point" => auth()->user()->point + $refundPrice
        ]);

        auth()->user()->refunds()->create([
            "letter_id" => $letter->id,
            "price" => $refundPrice
        ]);

        $letter->update(["refunded" => 1]);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
}
