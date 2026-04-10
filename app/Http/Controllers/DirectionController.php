<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;
use Validator;
use DB;

class DirectionController extends Controller
{
    public function index()
    {   
        $directions = Direction::get();
        return view('directions/direction', ['directions' => $directions]);
    }

    public function create()
    {
       
        return view('directions/create_direction');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'titre' => 'required',  
            'image' => 'required',
            'description' => 'required',
            'detail' => 'required',
        ]);
        // dd($request->type);
        if($validator->passes()){
            $direction = new Direction();
            $direction->titre = $request->titre;
            $direction->image = $request->image;
            $direction->description = $request->description;
            $direction->detail = $request->detail;

            $save = $direction->save();
        if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/directions/', $newFileName);
                $direction->image = $newFileName;
                $save = $direction->save();
            }
            if($save){
                $request->session()->flash('success', 'la direction est enregistrer avec succes...!');
                return redirect()->route('directions.index');
            }

        }else{
            return redirect()->route('directions.index')->withErrors($validator);
        }
    }
    public function show($id)
    {   
       
        $directions = Direction::get();
        return view('directions/direct', ['directions' => $directions]);
    }


    public function edit($id){
        $direction = direction::findOrFail($id);
        return view('directions/edit_direction' , ['direction' => $direction]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
                'nom' => 'required',
                'description' => 'required',
                'image' => 'required'
        ]);

        if($validator->passes()){
            $direction = Direction::find($id);
            $direction->nom = $request->nom;
            $direction->description = $request->description;
            $direction->image = $request->image;
            $save = $direction->save();
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().rand().'.'.$ext;
                $request->image->move(public_path().'/images/directions/', $newFileName);
                $direction->image = $newFileName;
                $save = $direction->save();
            }
            if($save){
                $request->session()->flash('success', 'L direction a été modifié avec succes...!');
                return redirect()->route('admin.directions.home');
            }

        }else{
            return redirect()->route('admin.directions.home')->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        
        $direction = Direction::findOrFail($id);
        $direction->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('directions.index');
    }
}
