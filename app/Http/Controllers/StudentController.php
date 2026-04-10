<?php

namespace App\Http\Controllers;

use File;
use Validator;
use App\Models\Courses;
use App\Models\Student;
use Illuminate\Http\Request;



class StudentController extends Controller
{
    public function home(){
        return view('home');
    }

    public function students(){
        $students = Student::get();
        return view('students', ['students' => $students]);
    }

    public function create(){
        return view('create_student');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
        ]);
        // dd($request->mat_id);
        if($validator->passes()){
            $student = new Student();
            $student->name = $request->name;
            $student->sex = $request->sex;
            $student->age = $request->age;
            $student->address = $request->address;

            $save = $student->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/students/', $newFileName);
                $student->image = $newFileName;
                $save = $student->save();
            }
            if($save){
                $request->session()->flash('success', 'L\'Etudiant est enregistrer avec succés...!');
                return redirect()->route('index.student');
            }

        }else{
            return redirect()->route('index.student')->withErrors($validator);
        }
    }

    public function edit($id){
        $student = Student::findOrFail($id);
        $courses = Courses::get();
        return view('edit_student' , ['student' => $student, 'courses' => $courses]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
        ]);
        if($validator->passes()){
            $student = Student::find($id);
            $student->name = $request->name;
            $student->sex = $request->sex;
            $student->age = $request->age;
            $student->address = $request->address;
            $save = $student->save();
            if($request->image){
                $oldImage = $student->image;
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/students/', $newFileName);
                $student->image = $newFileName;
                $save = $student->save();

                File::delete(public_path().'/images/students/'.$oldImage);
            }
            if($save){
                $request->session()->flash('success', 'L\'Etudiant a été modifié avec succés...!');
                return redirect()->route('index.student');
            }

        }else{
            return redirect()->route('index.student')->withErrors($validator);
        }
    }

    public function show(){
        return view('student_show');
    }

    public function destroy(Request $request, $id){
        $student = Student::findOrFail($id);
        File::delete(public_path().'/images/students/'.$student->image);
        $student->delete();

        $request->session()->flash('success', 'L\'Etudiant a été supprimé avec succés...!');
        return redirect()->route('index.student');
    }
}
