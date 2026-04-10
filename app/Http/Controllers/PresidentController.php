<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\President;
use Validator;
use DB;

class PresidentController extends Controller
{
    public function index()
    {   
        $presidents = President::get();
        return view('presidents/president', ['presidents' => $presidents]);
    }

    public function home(){
        $presidents = DB::table('presidents')->select('presidents.*')->latest()->take(3)->get();
        return view('presidents/admin_president', compact('presidents'));
    }

    public function create()
    {
       
        return view('presidents/create_president');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [  
            'image' => 'required',
            'titre' => 'required',
            'description' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $president = new President();
            $president->image = $request->image;
            $president->titre = $request->titre;
            $president->description = $request->description;
            
            $save = $president->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/presidents/', $newFileName);
                $president->image = $newFileName;
                $save = $president->save();
            }
            if($save){
                $request->session()->flash('success', 'le organigramme est enregistrer avec succes...!');
                return redirect()->route('admin.presidents.home');
            }

        }else{
            return redirect()->route('admin.presidents.home')->withErrors($validator);
        }
    
    }
    public function show($id)
    {   
        
        $presidents = President::get();
        return view('presidents/presi', ['presidents' => $presidents]);
    }


    public function edit($id){
        $president = president::findOrFail($id);
        return view('presidents/edit_president' , ['president' => $president]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'titre' => 'required',
                'description' => 'required',
                'image' => 'required'
        ]);

        if($validator->passes()){
            $president = President::find($id);
            $president->titre = $request->titre;
            $president->description = $request->description;
            $president->image = $request->image;
            $save = $president->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/presidents/', $newFileName);
                $president->image = $newFileName;
                $save = $president->save();
            }
            if($save){
                $request->session()->flash('success', 'L president a été modifié avec succes...!');
                return redirect()->route('admin.presidents.home');
            }

        }else{
            return redirect()->route('admin.presidents.home')->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        
        $president = President::findOrFail($id);
        $president->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.presidents.home');
    }
}
