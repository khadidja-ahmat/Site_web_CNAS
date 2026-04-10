<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adresse;
use Validator;
use DB;

class AdresseController extends Controller
{
    public function index()
    { 
        /* 
        $contacts = DB::table('adresse')->select('adresse.*')->latest()->take(1)->get(); */
        $adresses = Adresse::get();
        return view('adresses/adresse', compact('adresses')); 
    }

    public function home(){
        $adresses = DB::table('adresses')->select('adresses.*')->latest()->take(3)->get();
        return view('adresses/admin_adresse', compact('adresses'));
    }

    public function create()
    {
       
        return view('adresses/create_adresse');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tel' => 'required',  
            'heure' => 'required',  
            'email' => 'required',
            'site' => 'required',
            'adresse' => 'required',
            'lieu' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $adresse = new Adresse();
            $adresse->tel = $request->tel;
            $adresse->heure = $request->heure;
            $adresse->email = $request->email;
            $adresse->site = $request->site;
            $adresse->adresse = $request->adresse;
            $adresse->lieu = $request->lieu;
            $save = $adresse->save();
            if($save){
                $request->session()->flash('success', 'le adresse est enregistrer avec succes...!');
                return redirect()->route('admin.contacts.home');
            }

        }else{
            return redirect()->route('admin.contacts.home')->withErrors($validator);
        }
    }
    public function show($id)
    {
       
        $adresses = Adresse::get();
        return view('adresses/adre', compact('adresses')); 
    }


    public function edit($id)
    {
       
            $adresse = Adresse::findOrFail($id);
            return view('adresses/edit_adresse' , ['adresse' => $adresse]);
       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [  
            'tel' => 'required',  
            'heure' => 'required',  
            'email' => 'required',
            'site' => 'required',
            'adresse' => 'required',
            'lieu' => 'required'
        ]);

        if($validator->passes()){
            
            $adresse= Adresse::find($id);
            $adresse->tel = $request->tel;
            $adresse->heure = $request->heure;
            $adresse->email = $request->email;
            $adresse->site = $request->site;
            $adresse->adresse = $request->adresse;
            $adresse->lieu = $request->lieu;
            $save = $adresse->save();

            if($save){
                $request->session()->flash('success', 'L adresse a été modifié avec succés...!');
                return redirect()->route('admin.contacts.home');
            }

        }else{
            return redirect()->route('admin.contacts.home')->withErrors($validator);
        }


    }
    public function destroy($id)
    {
        
        $adresse = Adresse::findOrFail($id);
        $adresse->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('adresses.index');
    }


}
