<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColorSettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialurlController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendSMSController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::group(['middleware' => 'visitor_log'], function(){
        Route::get('/', function () {
            return redirect('login');
        });
    });

// Email Verification Route start
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('admin/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// Email Verification Route start


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.index');
// })->name('dashboard');



// Frontend Routing 

// Employee Custom Login / Registration / Forget Password / also check custom Middleware start
    Route::group(['middleware' => 'empAlreadyLoggedIn'], function(){
        Route::get('emp/login', [EmployeeController::class, 'emp_login'])->name('emp.login');
        Route::get('emp/register', [EmployeeController::class, 'emp_register'])->name('emp.register');
    });

    Route::group(['middleware' => 'empAuthMiddleware'], function(){
        Route::get('emp/dashboard', [EmployeeController::class, 'emp_dashboard'])->name('emp.dashboard');

        Route::post('emp/attendance/login', [AttendanceController::class, 'check_in'])->name('emp.attendance.login');
        Route::post('emp/attendance/logout', [AttendanceController::class, 'check_out'])->name('emp.attendance.logout');

        Route::get('emp/attendance/list/{name}', [AttendanceController::class, 'emp_attendance_list'])->name('emp.attendance.list');
    });

    Route::post('emp/register/store', [EmployeeController::class, 'emp_register_store'])->name('emp.register.store');
    Route::post('emp/login/check', [EmployeeController::class, 'emp_login_check'])->name('emp.login.check');

    Route::post('emp/logout', [EmployeeController::class, 'emp_logout'])->name('emp.logout');

    Route::get('emp/forget/password', [EmployeeController::class, 'emp_forget_password'])->name('emp.forget.password');
    Route::post('emp/password/email', [EmployeeController::class, 'emp_password_email'])->name('emp.password.email');

    Route::get('emp/passwod/reset/{token}', [EmployeeController::class, 'emp_password_reset_form'])->name('emp.reset.password.form');
    Route::post('emp/password/update', [EmployeeController::class, 'emp_password_update'])->name('emp.password.update');
// Employee Custom Login / Registration / Forget Password / also check custom Middleware end 





// Admin Group Route
Route::group(['prefix' => 'admin','middleware' => ['auth','verified']], function(){

    // Employee Controller Route
    Route::resource('employees', EmployeeController::class);


    // Attendance route start
    Route::get('view/attendance', [AttendanceController::class, 'admin_view_attendance'])->name('admin.view.attendance');
    Route::delete('delete/emp/attendance/{id}', [AttendanceController::class, 'delete_emp_attendance'])->name('delete.emp.attendance');

    // date wise attendance filter route
    Route::post('date/wise/attendance/', [AttendanceController::class, 'date_wise_attendance'])->name('date.wise.attendance');
    Route::post('date/clear/wise/attendance/', [AttendanceController::class, 'date_clear_wise_attendance'])->name('date.clear.wise.attendance');

    // search wise attendance route
    Route::post('search/wise/attendance/', [AttendanceController::class, 'search_wise_attendance'])->name('search.wise.attendance');

    // selected attendance export pdf, excel, csv
    Route::post('export/emp/attendance/pdf', [AttendanceController::class, 'export_emp_attendance_pdf'])->name('export.emp.attendance.pdf');
    Route::post('export/emp/attendance/excel', [AttendanceController::class, 'export_emp_attendance_excel'])->name('export.emp.attendance.excel');
    Route::post('export/emp/attendance/csv', [AttendanceController::class, 'export_emp_attendance_csv'])->name('export.emp.attendance.csv');

    // import excel csv 
    Route::post('import/emp/attendance/csv', [AttendanceController::class, 'import_emp_attendance_csv'])->name('import.emp.attendance.csv');
    Route::post('import/emp/attendance/excel', [AttendanceController::class, 'import_emp_attendance_excel'])->name('import.emp.attendance.excel');

    //filter by all-single attendance
    Route::post('filter/by/all/attendance', [AttendanceController::class, 'filter_by_all_attendance'])->name('filter.by.all.attendance');
    Route::post('filter/by/single/attendance', [AttendanceController::class, 'filter_by_single_attendance'])->name('filter.by.single.attendance');

    // selected attendance delete
    Route::delete('selected/attendance/delete', [AttendanceController::class,'selected_attendance_delete'])->name('selected.attendance.delete');



    // send sms mobile phone
    Route::get('send-sms', [SendSMSController::class, 'index']);

    // product controller
    Route::resource('products', ProductController::class);
    
    // user role
    Route::get('user/role', [AdminController::class, 'user_role'])->name('user_role');
    Route::post('user/role/store', [AdminController::class, 'user_role_store'])->name('user_role.store');

    Route::get('post', [TestController::class, 'post'])->name('post.index');
    Route::get('comments', [TestController::class, 'comments'])->name('comments.index');


     // AdminController
     Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
     Route::get('users/list', [AdminController::class, 'userList'])->name('users.index');
     Route::get('users/{id}/destroy', [AdminController::class, 'userDestroy'])->name('users.destroy');

    //  GeneralSettingController
    Route::resource('generalSettings', GeneralSettingController::class);

    //  ColorSettingController
    Route::resource('colorSettings', ColorSettingController::class);

    //  SocialurlController
    Route::resource('socialurls', SocialurlController::class);

    // ThemeSettingController 
    Route::get('theme-color', [ThemeSettingController::class, 'color'])->name('theme.color');
    Route::get('theme-toggle', [ThemeSettingController::class, 'toggle'])->name('theme.toggle');

});

    //  ContactController
    Route::resource('contacts', ContactController::class);

    //  SubscriberController
    Route::resource('subscribers', SubscriberController::class);
