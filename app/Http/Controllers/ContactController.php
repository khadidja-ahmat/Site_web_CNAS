<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Adresse;
use Validator;
use DB;

class ContactController extends Controller
{
    public function index()
    {   
        $contacts = Contact::get();
        $adresses = Adresse::get();
        
        return view('contacts/contact', compact('contacts','adresses'));
    }

    public function home()
    {
        $contacts =  Contact::get();
        return view('contacts/admin_contacts', ['contacts' => $contacts]);
    }

    public function create()
    {
       
        $contacts = Contact::get();
        return view('contacts/create_contact', ['contacts' => $contacts]);
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nom' => 'required',  
            'email' => 'required',
            'objet' => 'required',
            'message' => 'required',
        ]);
        if($validator->passes()){
            $contact = new Contact();
            $contact->nom = $request->nom;
            $contact->email = $request->email;
            $contact->objet = $request->objet;
            $contact->message = $request->message;
            $save = $contact->save();
            if($save){
                $request->session()->flash('success', 'le slider est enregistrer avec succes...!');
                return redirect()->route('contacts.index');
            }

        }else{
            return redirect()->route('contacts.index')->withErrors($validator);
        }
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       
            $contact = Contact::findOrFail($id);
            return view('contacts/edit_contact' , ['contact' => $contact]);
       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',  
            'email' => 'required',
            'objet' => 'required',
            'message' => 'required',
        ]);

        if($validator->passes()){
            
            $contact= Contact::find($id);
            $contact->nom = $request->nom;
            $contact->email = $request->email;
            $contact->objet = $request->objet;
            $contact->message = $request->message;
            $save = $contact->save();

            if($save){
                $request->session()->flash('success', 'Le consultation a été modifié avec succés...!');
                return redirect()->route('contacts.index');
            }

        }else{
            return redirect()->route('admin.contacts.home')->withErrors($validator);
        }


    }
    public function destroy($id)
    {
        
        $contact = Contact::findOrFail($id);
        $contact->delete();
/* 
        $request->session()->flash('success', 'Le slider a été supprimé avec succés...!'); */
        return redirect()->route('contacts.index');
    }

}
