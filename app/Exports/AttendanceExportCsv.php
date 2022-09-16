<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExportCsv implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $attendance_id = '';

    public function __construct($attendance_id)
    {   
        $this->attendance_id = $attendance_id;
    }
    public function collection()
    {
        $attendance_array = explode(',', $this->attendance_id);

       return Attendance::whereIn('id', $attendance_array)->get(['name', 'designation', 'check_in', 'check_out', 'created_at']);
    }

    // public function headings(): array
    // {
    //     return ['name', 'designation', 'check in', 'check out', 'created date', 'updated date'];
    // }
}
