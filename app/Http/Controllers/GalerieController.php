<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galerie;
use Validator;
use DB;
class GalerieController extends Controller
{
    public function index()
    {   
        $galeries = Galerie::get();
        return view('galeries/galerie', ['galeries' => $galeries]);
    }
    
    public function home()
    {
        $galeries =  Galerie::get();
        return view('galeries/galerié_admin', ['galeries' => $galeries]);
    }

    public function create()
    {
       
        return view('galeries/create_galerie');
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
            $galerie = new Galerie();
            $galerie->titre = $request->titre;
            $galerie->image = $request->image;
            $galerie->description = $request->description;

            $save = $galerie->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/galeries/', $newFileName);
                $galerie->image = $newFileName;
                $save = $galerie->save();
            }
            if($save){
                $request->session()->flash('success', 'la galerie est enregistrer avec succes...!');
                return redirect()->route('admin.galeries.home');
            }

        }else{
            return redirect()->route('admin.galeries.home')->withErrors($validator);
        }
    }
    public function show($id)
    {   
        
        $galeries = Galerie::get();
        return view('galeries/galeri', ['galeries' => $galeries]);
    }


    public function edit($id){
        $galerie = galerie::findOrFail($id);
        return view('galeries/edit_galerie' , ['galerie' => $galerie]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'titre' => 'required',
                'description' => 'required',
                'image' => 'required'
        ]);

        if($validator->passes()){
            $galerie = Galerie::find($id);
            $galerie->titre = $request->titre;
            $galerie->description = $request->description;
            $galerie->image = $request->image;
            $save = $galerie->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/galeries/', $newFileName);
                $galerie->image = $newFileName;
                $save = $galerie->save();
            }
            if($save){
                $request->session()->flash('success', 'L galerie a été modifié avec succes...!');
                return redirect()->route('admin.galeries.home');
            }

        }else{
            return redirect()->route('admin.galeries.home')->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        
        $galerie = Galerie::findOrFail($id);
        $galerie->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.galeries.home');
 
    }
}
