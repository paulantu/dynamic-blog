<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{



    public function __construct(){

    }






    public function Index(){

        return view('admin.search');
    }









    public function AdminAutoSearch(Request $request)
    {
        $query = $request->get('query');
        $adminName = User::where('name', 'LIKE', '%'. $query. '%')->get();
        $adminEmail = User::where('email', 'LIKE', '%'. $query. '%')->get();
        return response()->json([$adminName,$adminEmail]);
    }
}
