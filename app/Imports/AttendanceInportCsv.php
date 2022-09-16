<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;

class AttendanceInportCsv implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'name' => $row[0],
            'designation' => $row[1],
            'check_in' => $row[2],
            'check_out' => $row[3],
            'created_at' => $row[4],
        ]);
    }
}
