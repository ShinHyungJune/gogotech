<?php

namespace App\Http\Controllers;

use App\Enums\Agent;
use App\Enums\MessageType;
use App\Http\Resources\BookResource;
use App\Http\Resources\LetterResource;
use App\Http\Resources\TestLetterResource;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Letter;
use App\Models\LetterLog;
use App\Models\Pinco;
use App\Models\Reject;
use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "started_at" => "nullable|date",
            "finished_at" => "nullable|date",
        ]);

        if(!$request->started_at)
            $request["started_at"] = Carbon::now()->format("Y-m-d");

        if(!$request->finished_at)
            $request["finished_at"] = Carbon::now()->format("Y-m-d");

        $letters = auth()->user()->letters();

        if($request->started_at)
            $letters = $letters->where("created_at", ">=", Carbon::make($request->started_at)->startOfDay());

        if($request->finished_at)
            $letters = $letters->where("created_at", "<=", Carbon::make($request->finished_at)->endOfDay());

        $letters = $letters->orderBy("created_at", "desc")->paginate(30);

        return Inertia::render("Letters/Index", [
            "letters" => LetterResource::collection($letters),
            "started_at" => $request->started_at,
            "finished_at" => $request->finished_at,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "category" => "required|string|max:500",
            "company" => "required|string|max:500",
            "type" => "required|string|max:500",
            "description" => "required|string|max:5000",
            "book_id" => "nullable|integer",
            "contacts" => "nullable|array",
            "pushed_at" => "nullable|string|max:500",
        ]);

        $request["description"] = "($request->category)$request->company\n$request->description\n무료거부0808550688";

        if(!$request->pushed_at)
            $request["pushed_at"] = Carbon::now()->format("Y-m-d H:i");

        $request["pushed_at"] = Carbon::make($request->pushed_at)->format("Y-m-d H:i");

        if($request->pushed_at <= Carbon::now()->setTime(9,0,0)->format("Y-m-d H:i") || $request->pushed_at >= Carbon::now()->setTime(21,0,0)->format("Y-m-d H:i"))
            return redirect()->back()->with("error", "오전 9시 ~ 오후 9시까지만 발송 가능합니다.");

        $agent = auth()->user()->agent;

        $sms = new SMS();

        $price = $request->type == MessageType::SMS ? auth()->user()->price_sms : auth()->user()->price_lms;

        $user = auth()->user();

        if($request->book_id){
            $book = Book::find($request->book_id);

            if(!$book)
                return redirect()->back()->with("error" , "존재하지 않는 주소록입니다.");

            if($book->user_id != auth()->id())
                return redirect()->back()->with("error" , "자신의 주소록만 사용할 수 있습니다.");

            $contacts = $book->contacts()->whereNotIn("contact", Reject::pluck("contact")->toArray())->get();

            if($contacts->count() * $price > auth()->user()->point)
                return redirect()->back()->with("error" , "포인트가 부족합니다.");

            $rejectCount = $book->contacts()->count() - $contacts->count();

            $count = $contacts->count();

            if(Agent::isNpro($agent) && $count <= 10)
                $agent = Agent::NPRO_SMALL;

            $letter = auth()->user()->letters()->create([
                "title" => $request->title ? $request->title : Str::limit($request->description, 20, $end='...'),
                "type" => $request->type,
                "description" => $request->description,
                "pushed_at" => $request->pushed_at,
                "price" => $price,
                "total_price" => $price * $count,
                "count_reject" => $rejectCount,
                "count" => $count,
                "agent" => $agent,
                "test" => $request->test ? $request->test : 0
            ]);

            $message =
"[문자발송이벤트알림]
아이디 : $user->ids
이벤트ID : $letter->id
발신번호 : $user->contact
발송시간 : $letter->created_at
========================
메시지타입 : $request->type
메시지내용 :
$request->description
========================
수신거부제외건수 : $rejectCount
발송생성건수 : $count
                ";

            if($agent == Agent::PINCO) {
                Http::get("https://api.telegram.org/bot1902186671:AAEmMDDxGA8O2O6folbXhU79s15nxkQROk0/sendMessage", [
                    "chat_id" => "-1001555998651",
                    "text" => $message
                ]);
            }else{
                Http::get(config("telegram.domain").config("telegram.key")."/sendMessage", [
                    "chat_id" => config("telegram.ids.letter_store"),
                    "text" => $message
                ]);
            }

            $sms->send($letter, $contacts->pluck("contact")->toArray());

            auth()->user()->update([
                "point" => auth()->user()->point - $price * $contacts->count()
            ]);
        }

        if(!$request->book_id){
            $rejectCount = Reject::whereIn("contact", $request->contacts)->count();

            $request["contacts"] = array_diff($request->contacts, Reject::pluck("contact")->toArray());

            if(count($request["contacts"]) * $price > auth()->user()->point)
                return redirect()->back()->with("error" , "포인트가 부족합니다.");

            $count = count($request["contacts"]);

            if(Agent::isNpro($agent) && $count <= 10)
                $agent = Agent::NPRO_SMALL;

            // 이미 수신거부수 걸러내서 아래내용 필요없음
            // $realCount = $count - $rejectCount;

            $letter = auth()->user()->letters()->create([
                "title" => $request->title ? $request->title : Str::limit($request->description, 20, $end='...'),
                "type" => $request->type,
                "description" => $request->description,
                "pushed_at" => $request->pushed_at,
                "price" => $price,
                "total_price" => $price * $count,
                "count_reject" => $rejectCount,
                "count" => $count,
                "agent" => $agent,
                "test" => $request->test ? $request->test : 0
            ]);

            $message =
"[문자발송이벤트알림]
아이디 : $user->ids
이벤트ID : $letter->id
발신번호 : $user->contact
발송시간 : $letter->created_at
=================
메시지타입 : $request->type
메시지내용 :
$request->description
=================
수신거부제외건수 : $rejectCount
발송생성건수 : $count
발송에이전트 : $agent
";

            if($agent == Agent::PINCO){
                Http::get("https://api.telegram.org/bot1902186671:AAEmMDDxGA8O2O6folbXhU79s15nxkQROk0/sendMessage", [
                    "chat_id" => "-1001555998651",
                    "text" => $message
                ]);
            }else{
                Http::get(config("telegram.domain").config("telegram.key")."/sendMessage", [
                    "chat_id" => config("telegram.ids.letter_store"),
                    "text" => $message
                ]);
            }

            $sms->send($letter, $request->contacts);

            auth()->user()->update([
                "point" => auth()->user()->point - $price * count($request["contacts"])
            ]);
        }

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    public function create(Request $request)
    {
        // $testLetter = auth()->user()->letters()->latest()->where("test", true)->first();

        $testLetter = null;

        $books = auth()->user()->books()->latest()->paginate(50);

        return Inertia::render("Letters/Create",[
            "type" => $request->type ? $request->type : "",
            "category" => $request->category ? $request->category : "",
            "description" => $request->description ? $request->description : "",
            "books" => BookResource::collection($books),
            "book_id" => $request->book_id ? $request->book_id : "",
            "sender" => $request->sender ? $request->sender : "",
            "pushed_at" => $request->pushed_at ? $request->pushed_at : "",
            "testLetter" => $testLetter ? TestLetterResource::make($testLetter) : "",
            // "letterLogs" => $letterLogs,
        ]);
    }
}
