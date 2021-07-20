<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    //
    public function __construct(){
        $this->addresses = new Addresses;
    }

    public function storage($cep,$students_id,$number){

        $this->addresses->create([
            'cep' => $cep,
            'students_id' => $students_id,
            'number' => $number
        ]);
    }
}
