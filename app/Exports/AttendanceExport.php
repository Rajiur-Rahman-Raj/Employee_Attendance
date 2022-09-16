<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $selected_attendance_id = '';

    public function __construct($selected_attendance_id)
    {
        $this->selected_attendance_id = $selected_attendance_id;
    }
    public function collection()
    {
        $attendance_id_array = explode(",", $this->selected_attendance_id);
        $all_selected_attendance_list = Attendance::whereIn('id', $attendance_id_array)->get(['name', 'designation', 'check_in', 'check_out', 'created_at']);
        return $all_selected_attendance_list;
    }

    // public function headings(): array
    // {
    //     return ["Emp Name", "Designation", 'Check In', 'Check Out', 'created_at'];
    // }
}
