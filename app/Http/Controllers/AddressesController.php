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

    public function storage($cep,$number){

        $this->addresses->create([
            'cep' => $cep,
            'number' => $number
        ]);
    }
}
