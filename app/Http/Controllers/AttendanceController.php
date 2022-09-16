<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use App\Exports\AttendanceExportCsv;
use App\Imports\AttendanceInportCsv;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImportExcel;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function check_in(Request $request){
    
        $name           = $request->emp_name;
        $designation    = $request->emp_designation;
    
        $employees      = Employee::all();

        $current_date   = date('Y-m-d');
    
        $emp_info       = Attendance::where('name', $name)->latest()->first();
    
        if ($emp_info) {
            
            $login_date = Carbon::Parse($emp_info->check_in)->format('Y-m-d');
    
            if ($current_date == $login_date) {
                return response()->json([
                    'message' => 'You are already checked in today!',
                ]);

            }else{
                foreach ($employees as $employee) {
                    if ($employee->name == $name) {
                        Attendance::create([
                             'name'          => $name,
                             'designation'   => $designation,
                             'check_in'      => Carbon::now(),
                             'status'        => 'login',
                             'created_at'    => Carbon::now(),
                        ]);
                        return response([
                            'status'         => 200,
                            'message'        => 'You are checked in today!',
                        ]);
                    } 
                }
            }
        }else{
    
            foreach ($employees as $employee) {
                if ($employee->name == $name) {
                    Attendance::create([
                         'name'          => $name,
                         'designation'   => $designation,
                         'check_in'      => Carbon::now(),
                         'status'        => 'login',
                         'created_at'    => Carbon::now(),
                    ]);

                    return response()->json([
                        'status'         => 200,
                        'message'        => 'You are checked in today!',
                    ]);
                }
             }
    
        }
    }
    
    
    public function check_out(Request $request){
    
        $name            = $request->emp_name;
        $designation     = $request->emp_designation;
    
         $employees      = Employee::all();
    
        $current_date    = date('Y-m-d');
    
        $emp_info        = Attendance::where('name', $name)->latest()->first();
    
        if($emp_info){ 
            $login_date  = Carbon::Parse($emp_info->check_in)->format('Y-m-d');
            $logout_date = Carbon::Parse($emp_info->check_out)->format('Y-m-d');
    
    
            if ($emp_info->check_out == null) {
               $logout_date = null;
            }
    
            if ($current_date == $logout_date) {
                return response([
                    'message' => 'You have already checked out today',
                ]);
            }else{
                Attendance::find($emp_info->id)->update([
                    'check_out'   => Carbon::now(),
                    'status'      => 'logout',
                    'updated_at'  => Carbon::now(),
                ]);
                
                return response([
                    'status'  => 200,
                    'message' => 'You are checked out today!',
                ]);
            }
    
        }else{
            return response([
                'message' => 'Please you are checked in first!'
            ]);
        }
    }

    public function emp_attendance_list($name){
        $emp_info = array();
        if(Session::has('emp_login_id')){
            $emp_info = Employee::where('id', Session::get('emp_login_id'))->first();
        }
        
        $emp_attendance_infos = Attendance::where('name', $name)->latest()->get();
        return view('employee.emp_dashboard.attendance_list', compact('emp_attendance_infos', 'name', 'emp_info'));
    }

    // admin see attendance 
    public function admin_view_attendance(){
        $emp_present        = null;
        $all_emp_name       = Attendance::distinct()->get(['name']);
        $all_emp_attendance = Attendance::orderBy('id', 'DESC')->latest()->simplePaginate(20);
        return view('admin.emp_attendance.admin_view_attendance', compact('all_emp_attendance', 'all_emp_name', 'emp_present'));
    }

    public function delete_emp_attendance($id){
        Attendance::find($id)->delete();
        return back()->with('success', 'Attendance delete successfully!');
    }

    public function date_wise_attendance(Request $request){
        
        $from_date    = Carbon::parse($request->from_date);

        $to_date      = Carbon::parse($request->to_date)->addDay();

        $emp_name     = $request->emp_name;

        if ($from_date && $to_date && $emp_name) {

            $all_emp_attendance  = Attendance::where('name', $emp_name)->whereBetween('created_at', [$from_date, $to_date])->latest()->get();

            $total_hour    = 0;
            $total_minutes = 0;

            if (count($all_emp_attendance) != 0) {
                
                foreach ($all_emp_attendance as $attendance) {
                     
                    $check_in_time         = Carbon::parse($attendance->check_in);
                    $check_out_time        = Carbon::parse($attendance->check_out);
                    $worked_hour           = $check_out_time->diffInHours($check_in_time);
                    $total_worked_minutes  = $check_out_time->diffInMinutes($check_in_time);
                    $worked_minutes        = $total_worked_minutes % 60;
                    
                    $total_hour            = $total_hour + $worked_hour;
                    $total_minutes         = $total_minutes + $worked_minutes;
    
                }

                $emp_total_worked_hours    = $total_hour + floor($total_minutes / 60);
                $emp_total_worked_minutes  = $total_minutes % 60;

                $emp_present               =   $all_emp_attendance->count();
                $emp_absent                =   Carbon::now()->daysInMonth - $emp_present;

                $emp_per_day_worked_hours   =  round($emp_total_worked_hours / $emp_present);
                $emp_per_day_worked_minutes = round($emp_total_worked_minutes / $emp_present);

                $emp_designation         =   Attendance::where('name', $emp_name)->get('designation')->first();
                $created_month_data      =   Attendance::where('name', $emp_name)->whereBetween('created_at', [$from_date, $to_date])->latest('created_at')->first();
                $selected_month          =   $created_month_data->created_at->format('M');

                $emp_present_absent_view =   view('includes.emp_attendance.view_present_absent', compact('emp_name', 'emp_designation', 'emp_present', 'emp_absent', 'emp_total_worked_hours', 'emp_total_worked_minutes', 'selected_month', 'emp_per_day_worked_hours', 'emp_per_day_worked_minutes'))->render();

                $count    = $all_emp_attendance->count();

                $view     = view('includes.emp_attendance.index', compact('all_emp_attendance'))->render();
                return response()->json(['data' => $view , 'data_two' => $emp_present_absent_view, 'count' => $count]);

            }

        }elseif ($from_date && $to_date) {

            $all_emp_attendance  = Attendance::whereBetween('created_at', [$from_date, $to_date])->get();

        }else{
            return 'single selected!';
        }


        
        $count   = $all_emp_attendance->count();


        $view    = view('includes.emp_attendance.index', compact('all_emp_attendance'))->render();
        return response()->json(['data' => $view , 'count' => $count]);
    }

    // date clear wise attendance
    public function date_clear_wise_attendance(Request $request){
        
        $all_emp_attendance   = Attendance::orderBy('id', 'DESC')->get();

        $view                 = view('includes.emp_attendance.index', compact('all_emp_attendance'))->render();
        return response()->json(['data' => $view]);
    }

    // search wise attendance method 
    public function search_wise_attendance(Request $request){
        if ($request->search_value != null) {
            $all_emp_attendance   = Attendance::where('name','LIKE','%' . $request->search_value . '%')->orWhere('designation', 'LIKE','%' . $request->search_value . '%')->get();
        } else {
            $all_emp_attendance   = Attendance::orderBy('id', 'DESC')->get();
        }

        $count = $all_emp_attendance->count();

        $view  = view('includes.emp_attendance.index', compact('all_emp_attendance'))->render();
        return response()->json(['data' => $view , 'count' => $count]);
    }

    // export attendance 
    // public function export_emp_attendance_pdf(Request $request){
    //     $selected_attendance_id = $request->attendance_id;
    //     $attendance_id_array    = explode(",", $selected_attendance_id);

    //     $emp_name        = Attendance::whereIn('id', $attendance_id_array)->latest()->first('name');
    //     $emp_designation = Attendance::whereIn('id', $attendance_id_array)->latest()->first('designation');
    //     $current_date    = date('d-m-Y');

    //     $all_selected_attendance_list = Attendance::whereIn('id', $attendance_id_array)->get();

    //     return view('admin.emp_attendance.export_emp_attendance_pdf', compact('all_selected_attendance_list', 'emp_name', 'current_date', 'emp_designation'));

    // }

    public function export_emp_attendance_excel(Request $request){
        return Excel::download(new AttendanceExport($request->attendance_id), 'attendance.xlsx');
    }

    public function export_emp_attendance_csv(Request $request){
        return Excel::download(new AttendanceExportCsv($request->attendance_id), 'attendance.csv');
    }

    public function filter_by_all_attendance(Request $request){

        $check_all_attendance = Attendance::whereIn('id', $request->attendance_array)->get();

        $total_hour    = 0;
        $total_minutes = 0;
        // $attendance_date = [];
        // $attendance_month = [];
        foreach ($check_all_attendance as $attendance) {
                     
            $check_in_time         = Carbon::parse($attendance->check_in);
            $check_out_time        = Carbon::parse($attendance->check_out);
            $worked_hour           = $check_out_time->diffInHours($check_in_time);
            $total_worked_minutes  = $check_out_time->diffInMinutes($check_in_time);
            $worked_minutes        = $total_worked_minutes % 60;
            
            $total_hour            = $total_hour + $worked_hour;
            $total_minutes         = $total_minutes + $worked_minutes;

            // $attendance_date []  =  $attendance->created_at->format('d'); 
            // $attendance_month [] = $attendance->created_at->format('M'); 

        }

        // $unique_months = array_unique($attendance_month);


        $count = $check_all_attendance->count();

        $emp_total_worked_hours     = $total_hour + floor($total_minutes / 60);
        $emp_total_worked_minutes   = $total_minutes % 60;

        $emp_per_day_worked_hours   =  round($emp_total_worked_hours / $count);
        $emp_per_day_worked_minutes = round($emp_total_worked_minutes / $count);

        $emp_name          = Attendance::whereIn('id', $request->attendance_array)->distinct()->first(['name']);
        $emp_designation   = Attendance::whereIn('id', $request->attendance_array)->distinct()->first(['designation']);


        $view  = view('includes.emp_attendance.check_all_attendance', compact('check_all_attendance', 'emp_name', 'emp_designation', 'emp_total_worked_hours', 'emp_total_worked_minutes', 'emp_per_day_worked_hours', 'emp_per_day_worked_minutes', 'count'))->render();
        return response()->json(['data' => $view , 'count' => $count]);
    }


    public function selected_attendance_delete(Request $request){
        $selected_attendance_id = $request->attendance_id;
        $attendance_id_array    = explode(",", $selected_attendance_id);

        if ($selected_attendance_id != '') {
            foreach ($attendance_id_array as $id) {
                Attendance::find($id)->delete();
            }
        }

        return back()->with('success', 'Attendance delete successfully!');
    }

    public function import_emp_attendance_csv(Request $request){
        Excel::import(new AttendanceInportCsv, request()->file('import_emp_attendance_csv'));
        return back()->with('success', 'import successfully!');
    }



    public function import_emp_attendance_excel(){
        Excel::import(new AttendanceImportExcel, request()->file('import_emp_attendance_excel'));
        return back()->with('success', 'Import Successfully!');
    }

    


}
