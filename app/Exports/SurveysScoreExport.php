<?php

namespace App\Exports;

use App\Enums\QuestionType;
use App\Enums\SectionType;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SurveysScoreExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function collection()
    {
        return $this->survey->users;
    }

    public function map($user): array
    {
        $userData = [
            $user->name,
            $user->contact,
            $user->men ? "남자" : "여자",
            Carbon::make($user->birth)->format("Y-m-d"),
            $user->location,
        ];

        $questionsData = [];

        $questions = $this->survey->questions()->cursor();

        foreach ($questions as $question) {
            $questionsData[] = $this->getScore($question, $user);
        }

        return array_merge($userData, $questionsData);
    }

    public function headings(): array
    {
        $headings = [
            "이름",
            "연락처",
            "성별",
            "생일",
            "거주지역"
        ];

        $questions = $this->survey->questions()->cursor();

        foreach ($questions as $question) {
            $headings[] = $question->title;
        }

        return $headings;
    }

    public function getScore(Question $question, User $user)
    {
        $answer = $question->answers()->where("user_id", $user->id)->first()->answer;

        if($question->section->type === "RANGE") {
            $result = [0,0];

            $options = $question->section->questions()->first()->options;

            $answers = json_decode($question->answers()->where("user_id", $user->id)->first()->answer);

            $index = 1;

            foreach($options as $option){
                if($option->title === $answers[0])
                    $result[0] = $index;

                if($option->title === $answers[1])
                    $result[1] = $index;

                $index++;
            }

            return $result;
        }

        if($question->type === "RADIO" || $question->type === "RANGE"){
            $result = "";

            $options = $question->options;

            $answer = json_decode($question->answers()->where("user_id", $user->id)->first()->answer);

            $index = 1;

            foreach($options as $option){
                if($option->title === $answer) {
                    $result = $index;

                    break;
                }

                $index++;
            }

            return $result;
        }

        if($question->type === "CHECKBOX"){
            $result = [];

            $options = $question->options;

            $answers = json_decode($question->answers()->where("user_id", $user->id)->first()->answer);

            $index = 1;

            foreach($options as $option){
                foreach($answers as $answer){
                    if($option->title === $answer)
                        $result[] = $index;
                }

                $index++;
            }

            return $result;
        }

        return json_decode($question->answers()->where("user_id", $user->id)->first()->answer);
    }
}
