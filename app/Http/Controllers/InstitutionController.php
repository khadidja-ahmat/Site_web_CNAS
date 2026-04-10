<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use Validator;
use DB;

class InstitutionController extends Controller
{
    public function index()
    {   
        $institutions = Institution::get();
        return view('institutions/institu', ['institutions' => $institutions]);
    }

    public function home(){
        $institutions = DB::table('institutions')->select('institutions.*')->latest()->take(3)->get();
        return view('institutions/admin_institutions', compact('institutions'));
    }

    public function create()
    {
       
        return view('institutions/create_institution');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'titre' => 'required',
            'description' => 'required',
        ]);
        if($validator->passes()){
            $institution = new Institution();
            $institution->titre = $request->titre;
            $institution->description = $request->description;
            $save = $institution->save();
            if($save){
                $request->session()->flash('success', 'le institution est enregistrer avec succes...!');
                return redirect()->route('admin.institutions.home');
            }

        }else{
            return redirect()->route('admin.institutions.home')->withErrors($validator);
        }
    }
    public function show($id)
    {   
        //
    }


    public function edit($id)
    {
       
            $institutions = Institution::findOrFail($id);
            return view('institutions/edit_institution' , ['institutions' => $institutions]);
       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required',
            'description' => 'required',
        ]);

        if($validator->passes()){
            
            $institution= Institution::find($id);
            $institution->titre = $request->titre;
            $institution->description = $request->description;
            $save = $institution->save();
                if($save){
                    $request->session()->flash('success', 'le institution est enregistrer avec succes...!');
                    return redirect()->route('admin.institutions.home');
                }
    
            }else{
                return redirect()->route('admin.institutions.home')->withErrors($validator);
            }

    }
    public function destroy($id)
    {
        
        $institution =Institution::findOrFail($id);
        $institution->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.institutions.home');
    }

}
