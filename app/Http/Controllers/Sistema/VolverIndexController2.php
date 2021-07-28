<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VolverIndexController2 extends Controller
{
    public function index(Request $request)
    { 

        return view('Login/Login');

    }
}

