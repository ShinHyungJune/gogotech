<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Certification;
use App\Models\User;
use App\Models\VerifyNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function username()
    {
        return 'ids';
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "ids" => "required|string|max:500",
            "password" => "required|string|max:500",
        ]);

        if(auth()->attempt($request->all())) {
            session()->regenerate();

            return redirect()->intended();
        }

        return Inertia::render("Users/Login", [
            "errors" => [
                "ids" => __("socialLogin.invalid")
            ]
        ]);
    }

    public function create(Request $request)
    {
        $certification = Certification::find($request->certification_id);

        if(!$certification)
            return redirect("/")->with("error", "본인인증 후 이용해주세요.");

        return Inertia::render("Users/Create", [
            "certification" => $certification,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "ids" => "required|string|max:500|unique:users",
            "contact" => "required|string|max:500|unique:users",
            "name" => "required|string|max:500",
            "email" => "required|string|max:500",
            "password" => "required|string|max:500|min:8|confirmed",
            "admin_ids" => "nullable|string|max:500"
        ]);

        $certification = Certification::where('contact', $request->contact)->first();

        if(!$certification)
            return redirect()->back()->with("error", "인증된 전화번호만 사용할 수 있습니다.");

        if($certification->user_id)
            return redirect()->back()->with("error", "다른 사용자가 사용중인 전화번호입니다.");

        $admin = null;

        if($request->admin_ids) {
            $admin = Admin::where("recommend_code", $request->admin_ids)->first();

            if(!$admin)
                return redirect()->back()->with("error", "존재하지 않는 추천인입니다. 추천인 코드를 재확인해주세요.");
        }

        $user = User::create([
            "admin_id" => $admin ? $admin->id : null,
            "admin_ids" => $admin ? $request->admin_ids : null,
            "ids" => $request->ids,
            "contact" => $request->contact,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $certification->update([
            "user_id" => $user->id
        ]);

        Http::get(config("telegram.domain").config("telegram.key")."/sendMessage", [
            "chat_id" => config("telegram.ids.user_store"),
            "text" =>
"[회원가입 승인요청]
고유번호 : {$user->id}
아이디 : {$user->ids}
이름 : {$user->name}
전화번호 : {$user->contact}
가입일자 : {$user->created_at}
"
        ]);

        return redirect("/login")->with("success", "성공적으로 가입되었습니다.");
    }

    public function socialLogin(Request $request, $social)
    {
        $socialUser = Socialite::driver($social)->user();

        // 일단 네이버
        $user = User::where("social_id", $socialUser->id)->where("social_platform", $social)->first();

        if(!$user) {
            $user = User::create([
                "name" => $social,
                "social_id" => $socialUser->id,
                "social_platform" => $social
            ]);
        }

        Auth::login($user);

        return redirect()->intended();
    }

    public function update(Request $request)
    {
        $request->validate([
            // "contact_change" => "nullable|string|max:500|unique:users,contact",
            "name" => "nullable|string|max:500",
            "email" => "nullable|email|max:500",
            "password" => "nullable|string|max:500|min:8|confirmed",
            "agree_ad" => "nullable|boolean",
        ]);


        /*if($request->contact_change){
            $verifyNumber = VerifyNumber::where('contact', $request->contact_change)
                ->where('verified', true)->first();

            if(!$verifyNumber)
                return redirect()->back()->with("error", "인증된 전화번호만 사용할 수 있습니다.");

            auth()->user()->update(["contact" => $request->contact_change]);

            $verifyNumber->delete();
        }*/

        if($request->name)
            auth()->user()->update(["name" => $request->name]);

        if($request->password)
            auth()->user()->update(["password" => Hash::make($request->password)]);

        if($request->email)
            auth()->user()->update(["email" => $request->email]);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    public function loginForm()
    {
        return Inertia::render("Users/Login");
    }

    public function edit(Request $request)
    {
        return Inertia::render("Users/Edit", [

        ]);
    }

    public function remove()
    {
        return Inertia::render("Users/Remove");
    }

    public function destroy(Request $request)
    {
        $request->validate([
            "reason" => "required|string|max:50000"
        ]);

        auth()->user()->update(["reason_leave_out" => $request->reason]);

        auth()->user()->delete();

        return redirect("/")->with("success", "성공적으로 탈퇴되었습니다.");
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/");
    }
}
