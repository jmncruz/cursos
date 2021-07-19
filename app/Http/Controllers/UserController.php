<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    private $page = 3;

    public function show(){
        $users = User::paginate($this->page);
        return view('admin/students', compact('users'));
    }
}
