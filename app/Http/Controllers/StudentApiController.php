<?php

namespace App\Http\Controllers;

use DB;
use File;
use Validator;
use Illuminate\Support\Str;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    public function students()
    {
        $courses = Student::get();
        return response()->json($courses, 200);

    }

    public function student($id)
    {
        try{
            $student = Student::where(['students.id' => $id])
                ->get();
            if (!$student) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cet enregistrement n\'existe pas'
                ], 404);
            }else{
                return response()->json(
                    $student[0]
                    , 200);
            }
        }catch (\Exception $exception){
            return response()->json([
                'status' => 404,
                'message' => $exception
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'sex' => 'required',
                'age' => 'required',
            ]);
            if($validator-> fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }

            $student = new Student();
            $student->name = $request->name;
            $student->sex = $request->sex;
            $student->age = $request->age;
            $student->address = $request->address;

            $save = $student->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = Str::random(15).time().".".$ext;
                $request->image->move(public_path().'/images/students/', $newFileName);
                $student->image = $newFileName;
                $save = $student->save();
            }

            if ($save)
                return response()->json([
                    'status' => 200,
                    'message' => 'Cet enregistrement est suvegardé avec success...!',
                    'student' => $student->toArray()
                ], 200);

            else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Cet enregistrement ne peut pas etre suvegardé!'
                ], 500);
            }

        }catch (\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
                // "message" => 'Cet enregistrement ne peut pas etre suvegardé ...!'
            ], 500);
        }
    }

    public function update(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'sex' => 'required',
                'age' => 'required',
            ]);
            if($validator->passes()){
                $student = Student::find($request->id);
                $student->name = $request->name;
                $student->sex = $request->sex;
                $student->age = $request->age;
                $student->address = $request->address;
                //dd($student);
                $updated = $student->save();
                if($request->image){
                    $oldImage = $student->image;
                    $ext = $request->image->getClientOriginalExtension();
                    $newFileName = time().rand().'.'.$ext;
                    $request->image->move(public_path().'/images/students/', $newFileName);
                    $student->image = $newFileName;
                    $updated = $student->save();

                    File::delete(public_path().'/images/students/'.$oldImage);
                }
                if ($updated){
                    return response()->json([
                        'status' => 200,
                        'message' => "L'enregistrement a ete modifier avec successe...!"
                    ], 200);

                }else{
                    return response()->json([
                        'status' => 200,
                        'message' => "L'enregistrement n'a pas ete modifier avec successe...!"
                    ], 200);
                }

            }
        }

        catch (\Exception $e){
            return response()->json([
                //"message" => $e->getMessage()
                //"message" => 'Cet enregistrement n\'existe pas'
            ], 404);

        }
    }

    public function delete ($id) {
        try {
            $studentdb = Student::where('id', $id)->get();
            //return $studentdb[0]->image;
           if($studentdb) {
                Student::where('id', $id)->delete();
                File::delete(public_path().'/images/students/'.$studentdb[0]->image);
                return response()->json([
                    "message" => 'Cet enregistrement est supprimé définitivement'
                ], 202);

            } else {
                return response()->json([
                    "message" => 'Cet enregistrement n\'existe pas'
                    // "message" => $blog
                ], 404);
            }
        }catch (\Exception $e){
            return response()->json([
                "message" => 'Cet enregistrement ne pas etre supprimer'
                //'message' => $e->getMessage()
            ], 400);
        }
    }
}


