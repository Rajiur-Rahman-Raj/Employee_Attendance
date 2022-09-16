<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Shetabit\Visitor\Models\Visit;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator;

class AdminController extends Controller
{
    public function index(){
        $total = Visit::whereIn('browser', ['IE', 'Firefox', 'Chrome', 'Safari', 'Opera'])->whereDate('created_at', '>', Carbon::now()->subDays(28))->get();
        $chrome = $total->where('browser', 'Chrome')->count();
        $firefox = $total->where('browser', 'Firefox')->count();
        $internet = $total->where('browser', 'IE')->count();
        $safari = $total->where('browser', 'Safari')->count();
        $opera = $total->where('browser', 'Opera')->count();

        $total = $total->count();
        $browser = [];
        $browser['chrome'] = round(($chrome /  $total) * 100);
        $browser['firefox'] = round(($firefox /  $total) * 100);
        $browser['internet'] = round(($internet /  $total) * 100);
        $browser['safari'] = round(($safari /  $total) * 100);
        $browser['opera'] = round(($opera /  $total) * 100);

        $today_page_views = Visit::whereDate('created_at', '=', Carbon::today())->count();

        $unique_users = User::count();


        $top_pages = Visit::select('url')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('url')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        return view('admin.index',compact( 'browser', 'today_page_views', 'unique_users', 'top_pages'));
    }

    // User List
    public function userList(){

        $users = User::orderBy('name', 'asc')->get();

        return view('admin.users.index', compact('users'));
    }
    
     // User Delete
    public function userDestroy($id){

        $user = User::find($id);

        $user->delete();

        return back()->withSuccess('User deleted');
    }

    public function user_role(){
        return view('admin.user_role.index');
    }

    public function user_role_store(Request $request){

        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);

        $role = Role::create($request->all());
        return back()->with('success', 'Role Created Successfully!');
    }
    
}
