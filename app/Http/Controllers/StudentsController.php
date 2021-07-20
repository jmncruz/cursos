<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Addresses;
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
            
            $this->students->create([
                'name' => $request->name,
                'status' => $request->status,
                'img_path' => $path,
                'courses' => $request->cursos,
                'students_cep' => $request->cep
            ]);

            $this->address->storage($request->cep,$this->students->latest('id')->first()->id,$request->numero);

            return redirect('/admin/students/show');
        }

    }
    public function show(){

        $students = $this->students->paginate(10);

        return view('admin/students', compact('students'));

    }
    public function showId($id){

     

        $students = $this->students->where('id',$id)->first();

        return response()->json($students);

    }
    public function delete(Request $request){
        
        $this->students->find($request->id)->delete();
        return response()->json(['success'=>'Curses Deleted successfully']);
    }
    public function update(Request $request){

        $this->students->find($request->id)->update([
            $request->field => $request->value,
        ]);
        return response()->json(['success'=>'Curses Deleted successfully']);
    }
}
