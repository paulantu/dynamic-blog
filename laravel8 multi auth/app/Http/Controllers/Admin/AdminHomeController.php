<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



//    Admin Dashboard view page

    public function AdminHome(){

        return view('admin.index');
    }
}
