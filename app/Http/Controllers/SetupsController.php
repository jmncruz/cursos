<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupsController extends Controller
{
    public function setup(){
        return view('admin/setups');
    }
}
