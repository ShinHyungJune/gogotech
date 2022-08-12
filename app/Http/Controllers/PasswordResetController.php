<?php

namespace App\Http\Controllers;

use App\Enums\Agent;
use App\Enums\MessageType;
use App\Mail\PasswordResetCreated;
use App\Models\Letter;
use App\Models\PasswordReset;
use App\Models\SMS;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PasswordResetController extends \ShinHyungJune\SocialLogin\Http\PasswordResetController
{
    public function store(Request $request)
    {
        $request->validate([
            "ids" => "required|string|max:500"
        ]);

        $user = User::where("ids", $request->ids)->first();

        if(!$user) {
            return redirect()->back()->with("error", "가입되지 않은 아이디입니다.");
        }

        $token = random_int(100000000,999999999);

        $passwordReset = PasswordReset::where("ids", $request->ids)->first();

        $passwordReset ? $passwordReset->update([
            "ids" => $request->ids,
            "token" => $token
        ]) : $passwordReset = PasswordReset::create([
            "ids" => $request->ids,
            "token" => $token
        ]);

        $sender = User::where("name", "문자아울렛")->firstOrCreate([
            "contact" => "070-7893-3469",
            "agent" => Agent::NPRO
        ]);

        $letter = $sender->letters()->create([
            "title" => "{$user->contact} 비밀번호 초기화 안내",
            "type" => MessageType::SMS,
            "description" => "[비밀번호 초기화 링크] ".$passwordReset->resetUrl()."\n"."-".config("app.name")."-",
            "pushed_at" => Carbon::now(),
            "price" => 0,
        ]);

        $sms = new SMS();

        $sms->send($letter, [$user->contact]);

        return redirect()->back()->with("success", "비밀번호 초기화 문자가 발송되었습니다.");
    }

    public function edit(Request $request)
    {
        return Inertia::render("PasswordResets/Edit", [
            "ids" => $request->ids,
            "token" => $request->token
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "ids" => "required|string|max:500",
            "token" => "required|string|max:5000",
            "password" => "required|string|min:8|max:500|confirmed"
        ]);

        $passwordReset = PasswordReset::where("ids", $request->ids)
            ->where("token", $request->token)
            ->first();

        $user = User::where("ids", $request->ids)->first();

        if(!$user || !$passwordReset){
            return redirect()->back()->with("error", "유효하지 않은 토큰이거나 존재하지 않는 아이디입니다.");
        }

        $user->update(["password" => Hash::make($request->password)]);

        return redirect("/login")->with("success", "비밀번호가 변경되었습니다.");
    }
}
