<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Galerie;
use App\Models\Contact;
use App\Models\Presentation;
use App\Models\President;
use App\Models\Organigramme;
use App\Models\Actualite;
use App\Models\Realisation;
use App\Models\Institution;
use DB;


class WebController extends Controller
{
    
    public function index()
    {
        $abouts = DB::table('abouts')->select('abouts.*')->latest()->take(1)->get();
        $galeries = DB::table('galeries')->select('galeries.*')->latest()->take(6)->get();
        $contacts = Contact::get();
        $presentations = Presentation::get();
        $organigrammes = DB::table('organigrammes')->select('organigrammes.*')->latest()->take(1)->get();
        $actualites = DB::table('actualites')->select('actualites.*')->latest()->take(3)->get();
        $presidents = DB::table('presidents')->select('presidents.*')->latest()->take(1)->get();
        $galeries = Galerie::get();   
        $realisations = Realisation::get();
        $institutions = Institution::get();
        return view('index', compact('realisations', 'presidents', 'presentations', 'abouts','actualites','galeries','organigrammes','contacts','institutions'));
    

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
