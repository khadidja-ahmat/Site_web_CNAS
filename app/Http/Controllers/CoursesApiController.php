<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesApiController extends Controller
{
    public function courses()
    {
        
        $students = DB::table('students')
            ->join('courses','students.mat_id','=','courses.id')
            ->select('courses.id as cours_id', 'courses.name as course',  'courses.description',  'students.*')
            ->get();
        return response()->json($students, 200);
    }
        
    public function findActivite($id)
    {
        try{
            $activit = DB::table('activites')
                ->join('admins','provinces.admin_id','=','admins.id')
                ->select('admins.name', 'admins.phone',  'admins.email',  'admins.user_profile', 'activites.*')
                ->where(['activites.id' => $id])
                ->get();
            if (!$activit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cet enregistrement n\'existe pas'
                ], 400);
            }else{
                return response()->json(
                    $activit
                    , 200);
            }
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception
            ], 400);
        }
    }

    public function storeActivite(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'lieu' => 'required',
        ]);

        $activite = new Activite();
        $activite->admin_id = $request->admin_id;
        $activite->super_id = $request->super_id;
        $activite->titre = $request->titre;
        $activite->date = $request->date;
        $activite->heure = $request->heure;
        $activite->lieu = $request->lieu;

        if ($activite->save())
            return response()->json([
                'success' => true,
                'text' => $activite->toArray()
            ], 201);
        else
            return response()->json([
                'success' => false,
                'message' => 'Cet enregistrement ne peut pas etre enregistrer!'
            ], 500);
    }

    public function updateActivite(Request $request) {
        try {
            $actvitedb = Activite::where('id', $request->id)->first();
            $actvite = array();
            $actvite['titre'] = is_null($request->titre) ? $actvitedb->titre : $request->titre;
            $actvite['date'] = is_null($request->date) ? $actvitedb->date : $request->date;
            $actvite['heure'] = is_null($request->heure) ? $actvitedb->heure : $request->heure;
            $actvite['lieu'] = is_null($request->lieu) ? $actvitedb->lieu : $request->lieu;
            $actvite['admin_id'] = $request->admin_id;
            $actvite['super_id'] = $request->super_id;
            $updated = DB::table('activites')->where('id', $request->id)->update($actvite);
            if ($updated){
                return response()->json([
                    'success' => true,
                    'message' => "L'enregistrement a ete modifier avec successe...!"
                ], 200);
            }
        }catch (\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
                //"message" => 'Cet enregistrement n\'existe pas'
            ], 404);
        }
    }


    public function deleteActivite ($id) {
        try {
            $activitedb = Activite::where('id', $id)->get();
            if($activitedb) {
                Activite::where('id', $id)->delete();
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
