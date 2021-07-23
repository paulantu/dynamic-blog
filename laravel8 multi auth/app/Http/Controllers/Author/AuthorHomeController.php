<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorHomeController extends Controller
{
    public function Index(){
        return view('author.index');
    }
}
