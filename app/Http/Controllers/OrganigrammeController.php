<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organigramme;
use Validator;
use DB;

class OrganigrammeController extends Controller
{
    public function index()
    {   
        $organigrammes = Organigramme::get();
        return view('organigrammes/organigramme', ['organigrammes' => $organigrammes]);
    }

    public function home(){
        $organigrammes = Organigramme::get();
        return view('organigrammes/admin_organigramme',['organigrammes' => $organigrammes]);
    }

    public function create()
    {
       
        return view('organigrammes/create_organigramme');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [  
            'image' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $organigramme = new Organigramme();
            $organigramme->image = $request->image;

            $save = $organigramme->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/organigrammes/', $newFileName);
                $organigramme->image = $newFileName;
                $save = $organigramme->save();
            }
            if($save){
                $request->session()->flash('success', 'le organigramme est enregistrer avec succes...!');
                return redirect()->route('admin.organigrammes.home');
            }

        }else{
            return redirect()->route('admin.organigrammes.home')->withErrors($validator);
        }
    }
    public function show($id)
    {
        $organigrammes = Organigramme::get();
        return view('organigrammes/organigramme', ['organigrammes' => $organigrammes]);
    }


    public function edit($id){
        $organigramme = organigramme::findOrFail($id);
        return view('organigrammes/edit_organigramme' , ['organigramme' => $organigramme]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'image' => 'required'
        ]);

        if($validator->passes()){
            $organigramme = Organigramme::find($id);
            $organigramme->image = $request->image;
            $save = $organigramme->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/organigrammes/', $newFileName);
                $organigramme->image = $newFileName;
                $save = $organigramme->save();
            }
            if($save){
                $request->session()->flash('success', 'L organigramme a été modifié avec succes...!');
                return redirect()->route('admin.organigrammes.home');
            }

        }else{
            return redirect()->route('admin.organigrammes.home')->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        
        $organigramme = Organigramme::findOrFail($id);
        $organigramme->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.organigrammes.home');
    }
    
}
