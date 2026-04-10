<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisation;
use Validator;
use DB;

class RealisationController extends Controller
{
    public function index()
    {   
        $realisations = Realisation::get();
        return view('realisations/realisation', ['realisations' => $realisations]);
    }

    public function home(){
        $realisations = DB::table('realisations')->select('realisations.*')->latest()->take(3)->get();
        return view('realisations/admin_realisations', compact('realisations'));
    }

    public function create()
    {
       
        return view('realisations/create_realisation');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [ 
            'titre' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $realisation = new Realisation();
            $realisation->titre = $request->titre;
            $realisation->description = $request->description;
            $realisation->image = $request->image;

            $save = $realisation->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/realisations/', $newFileName);
                $realisation->image = $newFileName;
                $save = $realisation->save();
            }
            if($save){
                $request->session()->flash('success', 'le realisation est enregistrer avec succes...!');
                return redirect()->route('admin.realisations.home');
            }

        }else{
            return redirect()->route('admin.realisations.home')->withErrors($validator);
        }
    }
    public function show($id)
    {
        
        $realisations = Realisation::get();
        return view('realisations/reali', ['realisations' => $realisations]);
    }


    public function edit($id){
        $realisation = realisation::findOrFail($id);
        return view('realisations/edit_realisation' , ['realisation' => $realisation]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'titre' => 'required',
                'description' => 'required',
                'image' => 'required'
        ]);

        if($validator->passes()){
            $realisation = Realisation::find($id);
            $realisation->titre = $request->titre;
            $realisation->description = $request->description;
            $realisation->image = $request->image;
            $save = $realisation->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/realisations/', $newFileName);
                $realisation->image = $newFileName;
                $save = $realisation->save();
            }
            if($save){
                $request->session()->flash('success', 'La realisation a été modifié avec succes...!');
                return redirect()->route('admin.realisations.home');
            }

        }else{
            return redirect()->route('admin.realisations.home')->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        
        $realisation =Realisation::findOrFail($id);
        $realisation->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.realisations.home');
    } }
