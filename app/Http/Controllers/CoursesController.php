<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CoursesController extends Controller
{
    //
    //
    
    public function __construct(){
        $this->courses = new Courses;
    }
    public function storage(Request $request){


        $this->courses->create([
            'name' => $request->value,
        ]);

        return response()->json(['success'=>'Curses Deleted successfully']);
    }
    public function update(Request $request){

        $this->courses->find($request->id)->update([
            $request->field => $request->value,
        ]);
        return response()->json(['success'=>'Curses Deleted successfully']);
    }
    public function show(){

        $courses = $this->courses->paginate(10);

        return view('admin/courses', compact('courses'));

    }
    public function delete(Request $request){
        $this->courses->find($request->id)->delete();
        return response()->json(['success'=>'Curses Deleted successfully']);
    }
    public function upload(Request $request){
        
        if($request->file('courses')->isValid()){
            $path = $request->file('courses')->store('public/courses');

            $this->readXml($path);

            Storage::delete([$path,]);

            return redirect('/admin/courses/show');
        }
        

    }
    public function readXml($file){
        $xmlDataString = file_get_contents(public_path('storage/../'.$file));
        $xmlObject = simplexml_load_string($xmlDataString);
                   
        $json = json_encode($xmlObject);
        $courses = json_decode($json, true); 


        foreach(array_unique($courses['curso'],SORT_REGULAR) as $course){

            if($this->courses->where('name',$course['nome'])->count() == 0){
                $this->courses->create([
                    'name' => $course['nome'],
                ]);
            }
        }
    }
    
}
