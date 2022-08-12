<?php

namespace App\Http\Controllers;

use App\Exports\SurveysExport;
use App\Http\Resources\BookResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\SurveyResource;
use App\Models\Book;
use App\Models\SMS;
use App\Models\Survey;
use App\Models\SurveyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mockery\Exception;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        $surveys = Survey::orderBy("created_at", "desc")->where("survey_id", null)->where("hide", 0)->paginate(12);

        return Inertia::render("Surveys/Index", [
            "surveys" => SurveyResource::collection($surveys)
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "survey_id" => "nullable|integer",
            "pre_survey_id" => "nullable|integer"
        ]);

        $survey = $request->survey_id ? Survey::find($request->survey_id) : Survey::create([
            "survey_id" => $request->pre_survey_id
        ]);

        if(!$survey)
            return redirect()->back()->with("error", "존재하지 않는 설문조사입니다.");

        $sections = $survey->sections()->orderBy("order", "asc")->paginate(1000);

        $latestSurveys = Survey::where("hide", 0)->orderBy("created_at", "desc")->paginate(10);

        return Inertia::render("Surveys/Create", [
            "survey_id" => $survey->id,
            "pre_survey_id" => $request->pre_survey_id,
            "survey" => SurveyResource::make($survey),
            "sections" => SectionResource::collection($sections),
            "latestSurveys" => SurveyResource::collection($latestSurveys)
        ]);
    }

    public function show(Survey $survey)
    {
        $books = Book::latest()->paginate(30);

        return Inertia::render("Surveys/Show", [
            "survey" => SurveyResource::make($survey),
            "books" => BookResource::collection($books)
        ]);
    }

    public function update(Survey $survey, Request $request)
    {
        $request->validate([
            "survey_id" => "nullable|integer",
            "title" => "required|string|max:500",
            "description" => "required|string|max:50000",
            "point" => "required|integer|min:0",
            "max" => "required|integer|min:1",
            "finished_at" => "required|date",
            "hide" => "required|boolean",
            "random_start" => "nullable|integer|min:0",
            "random_end" => "nullable|integer|min:0",
        ]);

        $request["hide"] = $survey->hide;

        if($request->img && !is_array($request->img))
            $survey->addMedia($request->img)->toMediaCollection("img", "s3");

        $survey->update($request->all());

        if($request->survey_id)
            return redirect("/surveys/create?survey_id=".$survey->id."&pre_survey_id=".$request->survey_id)->with("success", "성공적으로 처리되었습니다.");

        return redirect("/surveys/create?survey_id=".$survey->id)->with("success", "성공적으로 처리되었습니다.");
    }

    public function open(Survey $survey)
    {
        $survey->update(["hide" => 0]);

        return redirect("/surveys")->with("success", "성공적으로 처리되었습니다.");
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect("/surveys")->with("success", "성공적으로 처리되었습니다.");
    }

    public function copy(Request $request)
    {
        $request->validate([
            "survey_id" => "required|integer",
            "copy_survey_id" => "required|integer",
        ]);

        $survey = Survey::find($request->survey_id);
        $copySurvey = Survey::find($request->copy_survey_id);

        if(!$survey)
            return redirect()->back()->with("error", "존재하지 않는 설문조사입니다.");

        if(!$copySurvey)
            return redirect()->back()->with("error", "존재하지 않는 설문조사를 불러올 수 없습니다.");

        $survey->update(array_merge($copySurvey->toArray(), [
            "hide" => 1
        ]));

        $survey->sections()->delete();

        $sections = $copySurvey->sections;

        foreach($sections as $section){
            $createdSection = $survey->sections()->create($section->toArray());

            $questions = $section->questions;

            foreach($questions as $question){
                $createdQuestion = $createdSection->questions()->create($question->toArray());

                $options = $question->options;

                foreach($options as $option){
                    $createdQuestion->options()->create($option->toArray());
                }
            }
        }

        return redirect("/surveys/create?survey_id=".$survey->id)->with("success", "성공적으로 처리되었습니다.");
    }

    public function participate(Survey $survey)
    {
        if($survey->count_participate >= $survey->max)
            return redirect()->back()->with("error", "설문조사 인원모집이 마감되었습니다.");

        $userSurvey = auth()->user()->surveys()->find($survey->id);

        if(!$userSurvey)
            auth()->user()->surveys()->attach($survey->id);

        if($survey->survey){
            $preUserSurvey = auth()->user()->surveys()->find($survey->survey->id);

            if(!$preUserSurvey)
                return redirect("/surveys/participate/".$survey->survey->id);

            if($preUserSurvey->pivot->pass === 0)
                return redirect()->back()->with("error", "설문조사 대상이 아닙니다.");
        }

        $sections = $survey->sections()->orderBy("order", "asc")->paginate(1000);

        return Inertia::render("Surveys/Participate", [
            "survey" => SurveyResource::make($survey),
            "sections" => SectionResource::collection($sections)
        ]);
    }

    public function export(Survey $survey)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new SurveysExport($survey), $survey->title.".xlsx");
    }

    public function mine()
    {
        $surveys = auth()->user()->surveys()->paginate(10);

        return Inertia::render("Surveys/Mine", [
            "surveys" => SurveyResource::collection($surveys)
        ]);
    }

    public function sendTarget(Survey $survey, Request $request)
    {
        $request->validate([
            "men" => "nullable|boolean",
            "marriage" => "nullable|boolean",
            "birth_start" => "nullable|date",
            "birth_end" => "nullable|date",
            "location" => "nullable|array",
        ]);

        $users = new User();

        if(isset($request->men))
            $users = $users->where("men", $request->men);

        if(isset($request->marriage))
            $users = $users->where("marriage", $request->marriage);

        if($request->birth_start && $request->birth_end)
            $users = $users->where("birth", ">=",$request->birth_start)->where("birth", "<=", $request->birth_end);

        if(count($request->location) > 0)
            $users = $users->whereIn("location", $request->location);

        $users = $users->cursor();

        $sms = new SMS();

        foreach($users as $user){
            $sms->send("+82".$user->contact, "[".$survey->title."] 설문조사가 게시되었습니다.\n".config("app.url")."/surveys/".$survey->id);
        }

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    public function sendBook(Survey $survey, Request $request)
    {
        $request->validate([
            "book_id" => "required|integer",
        ]);

        $book = Book::find($request->book_id);

        if(!$book)
            return redirect()->back()->with("error", "존재하지 않는 주소록입니다.");

        $sms = new SMS();

        $contacts = $book->contacts()->latest()->cursor();

        foreach($contacts as $contact){
            $sms->send("+82".$contact->contact, "[".$survey->title."] 설문조사가 게시되었습니다.\n".config("app.url")."/surveys/".$survey->id);
        }

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
}
