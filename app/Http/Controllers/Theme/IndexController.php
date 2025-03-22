<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;

class   IndexController extends Controller
{
    public function index(){
     return view('welcome');
    }
}
