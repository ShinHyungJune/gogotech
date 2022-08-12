<?php

namespace App\Exports;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SurveysUserExport implements FromCollection
{
    use Exportable;

    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function collection()
    {
        $womenUsers = $this->survey->users()->where("men", 0)->get();

        $womenData = [
            "total" => $womenUsers->count(),
            "10" => $womenUsers
                ->where("birth", ">", Carbon::now()->subYears(20)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(10)->format("Y-m-d"))
                ->count(),
            "20" => $womenUsers
                ->where("birth", ">", Carbon::now()->subYears(30)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(20)->format("Y-m-d"))
                ->count(),
            "30" => $womenUsers
                ->where("birth", ">", Carbon::now()->subYears(40)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(30)->format("Y-m-d"))
                ->count(),
            "40" => $womenUsers
                ->where("birth", ">", Carbon::now()->subYears(50)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(40)->format("Y-m-d"))
                ->count(),
            "50" => $womenUsers
                ->where("birth", ">", Carbon::now()->subYears(60)->format("Y-m-d"))
                ->count(),
        ];

        $menUsers = $this->survey->users()->where("men", 1)->get();

        $menData = [
            "total" => $menUsers->count(),
            "10" => $menUsers
                ->where("birth", ">", Carbon::now()->subYears(20)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(10)->format("Y-m-d"))
                ->count(),
            "20" => $menUsers
                ->where("birth", ">", Carbon::now()->subYears(30)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(20)->format("Y-m-d"))
                ->count(),
            "30" => $menUsers
                ->where("birth", ">", Carbon::now()->subYears(40)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(30)->format("Y-m-d"))
                ->count(),
            "40" => $menUsers
                ->where("birth", ">", Carbon::now()->subYears(50)->format("Y-m-d"))
                ->where("birth", "<=", Carbon::now()->subYears(40)->format("Y-m-d"))
                ->count(),
            "50" => $menUsers
                ->where("birth", "<", Carbon::now()->subYears(60)->format("Y-m-d"))
                ->count(),
        ];

        return new Collection([
            [
                "",
                "남성",
                "여성",
                "총합계",
            ],
            [
                "10대",
                json_encode($menData["10"]),
                json_encode($womenData["10"]),
                json_encode($menData["10"] + $womenData["10"])
            ],
            [
                "20대",
                json_encode($menData["20"]),
                json_encode($womenData["20"]),
                json_encode($menData["20"] + $womenData["20"])
            ],
            [
                "30대",
                json_encode($menData["30"]),
                json_encode($womenData["30"]),
                json_encode($menData["30"] + $womenData["30"])
            ],
            [
                "40대",
                json_encode($menData["40"]),
                json_encode($womenData["40"]),
                json_encode($menData["40"] + $womenData["40"])
            ],
            [
                "50대 이상",
                json_encode($menData["50"]),
                json_encode($womenData["50"]),
                json_encode($menData["50"] + $womenData["50"])
            ],
            [
                "총합계",
                json_encode($menData["10"] + $menData["20"] + $menData["30"] + $menData["40"] + $menData["50"]),
                json_encode($womenData["10"] + $womenData["20"] + $womenData["30"] + $womenData["40"] + $womenData["50"]),
                json_encode($menData["10"] + $menData["20"] + $menData["30"] + $menData["40"] + $menData["50"] + $womenData["10"] + $womenData["20"] + $womenData["30"] + $womenData["40"] + $womenData["50"]),
            ]
        ]);
    }
}
