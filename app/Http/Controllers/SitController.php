<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;
use DB;


class SitController extends Controller
{
    
    public function index()
    {
        $directions = Direction::get();
        return view('details', compact('directions'));
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
