<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;
use Validator;

class ActiviteController extends Controller
{
    public function index()
    {   
        $activites = Activite::get();
        return view('activites/activite', ['activites' => $activites]);
    }

    public function create()
    {
       
        return view('activites/create_activite');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'titre' => 'required',  
            'image' => 'required',
            'description' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $activite = new Activite();
            $activite->titre = $request->titre;
            $activite->image = $request->image;
            $activite->description = $request->description;

            $save = $activite->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/activites/', $newFileName);
                $activite->image = $newFileName;
                $save = $activite->save();
            }
            if($save){
                $request->session()->flash('success', 'la direction est enregistrer avec succes...!');
                return redirect()->route('activites.index');
            }

        }else{
            return redirect()->route('activites.index')->withErrors($validator);
        }
    }
    public function show($id)
    {   
       
    }


    public function edit($id)
    {
       
            $activite = Activite::findOrFail($id);
            return view('activites/editactivite' , ['activite' => $activite]);
       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required',  
            'image' => 'required',
            'description' => 'required',
        ]);

        if($validator->passes()){
            
            $activite= Activite::find($id);
            $activite->titre = $request->titre;
            $activite->image = $request->image;
            $activite->description = $request->description;
           
            $save = $activite->save();

            if($save){
                $request->session()->flash('success', 'Le activite a été modifié avec succés...!');
                return redirect()->route('activites.index');
            }

        }else{
            return redirect()->route('activites.index')->withErrors($validator);
        }


    }
    public function destroy($id)
    {
        
        $activite = Activite::findOrFail($id);
        $activite->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('activites.index');
    }
}
