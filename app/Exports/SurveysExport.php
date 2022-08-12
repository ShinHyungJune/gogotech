<?php

namespace App\Exports;

use App\Models\Survey;
use App\Models\SurveyUser;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SurveysExport implements WithMultipleSheets
{
    use Exportable;

    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function sheets(): array
    {
        return [
            new SurveysAnswerExport($this->survey),
            new SurveysScoreExport($this->survey),
            new SurveysUserExport($this->survey)
        ];
    }
}
