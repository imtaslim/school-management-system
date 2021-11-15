<?php

namespace App\Imports;

use App\Models\Result;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class MarkImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        return new Result([
            'marks' => $row['marks'],
            'subject_id' => $row['subject_id'],
            'student_id' => $row['student_id'],

        ]);
    }

    public function rules(): array
    {
        return [
            '*.marks' => [
                'required',
            ],
            '*.subject_id' => [
                'required',
            ],
            '*.student_id' => [
                'required',
            ]
        ];
    }
}