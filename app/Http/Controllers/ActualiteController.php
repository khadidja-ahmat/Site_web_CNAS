<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
use Validator;
use DB;

class ActualiteController extends Controller
{
    public function index()
    {   
        $actualites = Actualite::get();
        return view('actualites/actu', ['actualites' => $actualites]);
    }

    public function home(){
        $actualites = DB::table('actualites')->select('actualites.*')->latest()->take(3)->get();
        return view('actualites/admin_actualite', compact('actualites'));
    }

    public function create()
    {
       
        return view('actualites/create_actualite');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [ 
            'titre' => 'required',
            'image' => 'required',
            'description' => 'required',
            'details' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $actualite = new Actualite();
            $actualite->titre = $request->titre;
            $actualite->image = $request->image;
            $actualite->description = $request->description;
            $actualite->details = $request->details;

            $save = $actualite->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/actualites/', $newFileName);
                $actualite->image = $newFileName;
                $save = $actualite->save();
            }
            if($save){
                $request->session()->flash('success', 'le actualite est enregistrer avec succes...!');
                return redirect()->route('admin.actualites.home');
            }

        }else{
            return redirect()->route('admin.actualites.home')->withErrors($validator);
        }
    }
    public function show($id)
    {
       
        $actualites = Actualite::get();
        return view('actualites/actuali', ['actualites' => $actualites]);
    }


    public function edit($id){
        $actualite = actualite::findOrFail($id);
        return view('actualites/edit_actualite' , ['actualite' => $actualite]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'titre' => 'required',
                'description' => 'required',
                'image' => 'required',
                'details' => 'required',
        ]);

        if($validator->passes()){
            $actualite = Actualite::find($id);
            $actualite->titre = $request->titre;
            $actualite->description = $request->description;
            $actualite->image = $request->image;
            $actualite->details = $request->details;
            $save = $actualite->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/actualites/', $newFileName);
                $actualite->image = $newFileName;
                $save = $actualite->save();
            }
            if($save){
                $request->session()->flash('success', 'L actualite a été modifié avec succes...!');
                return redirect()->route('admin.actualites.home');
            }

        }else{
            return redirect()->route('admin.actualites.home')->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        
        $actualite =Actualite::findOrFail($id);
        $actualite->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.actualites.home');
    }
}
