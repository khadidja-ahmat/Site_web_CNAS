<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Presentation;
use App\Models\President;
use App\Models\Organigramme;
use Validator;
use DB;

class AboutController extends Controller
{
    public function index()
    {   
        $abouts = About::get();
        $presidents = President::get();
        $presentations = Presentation::get();
        $organigrammes = Organigramme::get();
        return view('abouts/about', ['abouts' => $abouts, 'abouts' => $abouts,'presentations' => $presentations, 'organigrammes' => $organigrammes, 'presidents' => $presidents ]);
 /*        return view('abouts/about', compact('abouts', 'presidents', 'presentations'));
  */ 
    }

    public function home(){
        $abouts = DB::table('abouts')->select('abouts.*')->latest()->take(3)->get();
        return view('abouts/admin_apropos', compact('abouts'));
    }

    public function create()
    { 
       
        return view('abouts/create_about');
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
            $about = new about();
            $about->titre = $request->titre;
            $about->image = $request->image;
            $about->description = $request->description;

            $save = $about->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/abouts/', $newFileName);
                $about->image = $newFileName;
                $save = $about->save();
            }
            if($save){
                $request->session()->flash('success', 'le slider est enregistrer avec succes...!');
                return redirect()->route('admin.abouts.home');
            }

        }else{
            return redirect()->route('admin.abouts.home')->withErrors($validator);
        }
    
    }
    public function show($id)
    {   
        $abouts = About::get();
        return view('abouts/apropos', ['abouts' => $abouts]);
    }


    public function edit($id){
        $about = about::findOrFail($id);
        return view('abouts/edit_about' , ['about' => $about]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'titre' => 'required',
                'description' => 'required',
                'image' => 'required'
        ]);

        if($validator->passes()){
            $about = About::find($id);
            $about->titre = $request->titre;
            $about->description = $request->description;
            $about->image = $request->image;
            $save = $about->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/abouts/', $newFileName);
                $about->image = $newFileName;
                $save = $about->save();
            }
            if($save){
                $request->session()->flash('success', 'about modifié avec succes...!');
                return redirect()->route('admin.abouts.home');
            }

        }else{
            return redirect()->route('admin.abouts.home')->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        
        $about =About::findOrFail($id);
        $about->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.abouts.home');
    }
}
