<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\AddressesController;

class StudentsController extends Controller
{
    //
    public function __construct(){
        $this->students = new Students;
        $this->address = new AddressesController;
    }

    public function storage(Request $request){

        if($request->file('img_path')->isValid()){
            $path = $request->file('img_path')->store('public/students');
            
            $this->address->storage($request->cep,$request->numero);

            $this->students->create([
                'name' => $request->name,
                'status' => $request->status,
                'img_path' => $path,
                'courses' => $request->cursos,
                'students_cep' => $request->cep
            ]);

            return redirect('/admin/students/show');
        }
        
        dd($request->all());

        



    }
    public function show(){

        $students = $this->students->paginate(10);

        return view('admin/students', compact('students'));

    }
}
