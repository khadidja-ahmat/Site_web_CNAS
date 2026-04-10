<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
use App\Models\Direction;
use DB;


class WebbController extends Controller
{
    
    public function index()
    {
        
        $actualites = Actualite::get();
        return view('detail', compact('actualites'));
    

    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
     //
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
