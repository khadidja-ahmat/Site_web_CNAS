<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentation;
use Validator;
use DB;

class PresentationController extends Controller
{
    public function index()
    {   
        $presentations = Presentation::get();
        return view('presentations/presentation', ['presentations' => $presentations]);
    }

    public function home(){
        $presentations = DB::table('presentations')->select('presentations.*')->latest()->take(3)->get();
        return view('presentations/admin_presentation', compact('presentations'));
    }

    public function create()
    {
       
        return view('presentations/create_presentation');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if($validator->passes()){
            $presentation = new Presentation();
            $presentation->description = $request->description;
            $save = $presentation->save();
            if($save){
                $request->session()->flash('success', 'la presentation est enregistrer avec succes...!');
                return redirect()->route('admin.presentations.home');
            }

        }else{
            return redirect()->route('admin.presentations.home')->withErrors($validator);
        }
    }
    public function show($id)
    {   
        
        $presentations = Presentation::get();
        return view('presentations/presenta', ['presentations' => $presentations]);
    }


    public function edit($id)
    {
       
            $presentation = Presentation::findOrFail($id);
            return view('presentations/edit_presentation' , ['presentation' => $presentation]);
       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);

        if($validator->passes()){
            
            $presentation= Presentation::find($id);
            $presentation->description = $request->description;
            $save = $presentation->save();
                if($save){
                    $request->session()->flash('success', 'la presentation est enregistrer avec succes...!');
                    return redirect()->route('admin.presentations.home');
                }
    
            }else{
                return redirect()->route('admin.presentations.home')->withErrors($validator);
            }

    }
    public function destroy($id)
    {
        
        $presentation =Presentation::findOrFail($id);
        $presentation->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('admin.presentations.home');
    }

}
