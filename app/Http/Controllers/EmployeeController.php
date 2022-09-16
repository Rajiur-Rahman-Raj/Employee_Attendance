<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:employees',
            'designation'  => 'required|string|max:255',
            'address'      => 'required',
            'photo'        => 'required',
            'status'       => 'required',
        ]);

        $employee = Employee::create($request->except('_token') + ['created_at' => Carbon::now()]);

        if($request->hasFile('photo')){
            $main_photo      = $request->file('photo');
            $new_photo_name  = uniqid() . '.' . $main_photo->extension('photo');
            $upload_location = public_path('uploads/images/employee');

            $main_photo->move($upload_location, $new_photo_name);
            $employee->photo = $new_photo_name;
            $employee->save();
        }

        return redirect()->route('employees.index')->with('success', 'Employee Create Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $single_employee_details = Employee::find($employee->id);
        return view('admin.employee.show', compact('single_employee_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
       $single_employee_info = Employee::find($employee->id);
       return view('admin.employee.edit', compact('single_employee_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'designation'  => 'required|string|max:255',
            'address'      => 'required',
            'photo'        => 'required',
            'status'       => 'required',
        ]);

        $employee->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        if($request->hasFile('photo')){
            $main_photo      = $request->file('photo');
            $new_photo_name  = uniqid() . '.' . $main_photo->extension('photo');
            $upload_location = public_path('uploads/images/employee');

            $main_photo->move($upload_location, $new_photo_name);
            $employee->photo = $new_photo_name;
            $employee->save();
        }

        return redirect()->route('employees.index')->with('success', 'Employee Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::find($employee->id)->delete();
        return back()->with('success', 'Employee deleted successfully!');
    }

    // emp frontend route

    public function emp_login(){
        return view('employee.login');
    }

    public function emp_register(){
        return view('employee.register');
    }

    public function emp_register_store(Request $request){
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:employees',
            'designation'       => 'required',
            'password'          => 'required|min:6',
            'confirm_password'  => 'required|min:6|same:password',
            'photo'             => 'required',
        ]);

        $employee = Employee::create([
            'name'        => $request->name,
            'designation' => $request->designation,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'status'      => 'Deactive',
        ]);

        if ($request->hasFile('photo')) {
            $main_photo = $request->file('photo');
            $new_photo_name = uniqid() . '.' . $main_photo->extension('photo');
            $uploaded_location = public_path('uploads/images/employee');

            $main_photo->move($uploaded_location, $new_photo_name);

            $employee->photo = $new_photo_name;
            $employee->save();
            
        }

        return redirect()->route('emp.login')->with('success', 'Employee registration successfull!');
        
    }
    
    public function emp_login_check(Request $request){

        $employee = Employee::where('email', $request->email)->first();

        if ($employee && Hash::check($request->password, $employee->password)) {
            $request->session()->put('emp_login_id', $employee->id);
            return redirect('emp/dashboard');
        }else{
            return back()->with('error', 'Your Credential does not match with our records!');
        }
        
    }

    public function emp_dashboard(){
        $emp_info = array();
        if(Session::has('emp_login_id')){
            $emp_info = Employee::where('id', Session::get('emp_login_id'))->first();
        }

        // Attendance analytics for Employee
        $total_attendance   = [];

        for ($i=1; $i <=12 ; $i++) {
            $total_attendance []     = Attendance::where('name', $emp_info->name)->whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
        }

        return view('employee.emp_dashboard.index', compact('emp_info', 'total_attendance'));
    }

    public function emp_logout(){
        if(Session::has('emp_login_id')){
            Session::pull('emp_login_id');
        }

        return redirect()->route('emp.login');
    }

    public function emp_forget_password(){
        return view('employee.forget_password');
    }

    public function emp_password_email(Request $request){
        $request->validate([
            'email' => 'required|email|exists:employees,email',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'       => $request->email,
            'token'       => $token,
            'created_at'  => Carbon::now(),
        ]);

        $action_link = route('emp.reset.password.form', ['token' => $token, 'email' => $request->email]);
        $body        = "we are received a request to reset the password for <b>Laravel Boilerplate</b> account associated with " . $request->email . " You can reset your password by clicking the link below";

        Mail::send('employee.emp_email_forget', ['action_link' => $action_link, 'body' => $body], function($message) use ($request){
            $message->from('noreplay@example.com', "Laravel Boilerplate");
            $message->to($request->email, 'Rajiur Rahman')
                    ->subject('Emp Reset Password');
        });

        return back()->with('email_success', 'We have e-mailed your password reset link');

    }
 
    public function emp_password_reset_form(Request $request, $token = null){
        return view('employee.emp_password_reset_form')->with(['token' => $token, 'email' => $request->email]);
    }

    public function emp_password_update(Request $request){
        $request->validate([
            'email'            => 'required|email|exists:employees,email',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('invalid_token', 'Invalid Token');
        }else{
            Employee::where('email', $request->email)->update([
                'password' => Hash::make($request->password),
            ]);

            DB::table('password_resets')->where(['email' => $request->email])->delete();

            return redirect()->route('emp.login')->with('reset_info', "Your password has been changed, you can login with new password")->with('verifiedEmail', $request->email);
        }


    }



}
