<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



//    Admin Dashboard view page

    public function AdminHome(){

        $totalUsers = User::select('id')->count();
        $newUsers = User::select('id')->whereDate('created_at', '>', Carbon::now()->subDays(30))->count();
        return view('admin.index', compact('totalUsers','newUsers'));
    }
}
