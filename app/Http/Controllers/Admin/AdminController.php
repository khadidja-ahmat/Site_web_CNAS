<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Validator;

class AdminController extends Controller
{

    public function index()
    {
        $students = Student::get();
        return view('admin.admin-dash', ['students' => $students]);
    }

    public function admins()
    {
        $admins = Admin::get();
        return view('admin.admin.admins', ['admins' => $admins]);
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed'],
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id): View
    {
       $user = Admin::findOrFail($id);

       return view('admin.profile.edit', ['user' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
        ]);

        //if($validator->passes()){
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $save = $admin->save();
        if($save){
                $request->session()->flash('success', 'L\'Administrateur a été modifié avec succés...!');
                return redirect()->route('admin.admins');
        }else{
            return redirect()->route('admin.admins')->withErrors($validator);
        }

    }


    public function destroy(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        $request->session()->flash('success', 'L\'Administrateur a été supprimé avec succés...!');

        return redirect()->route('admin.logout');
    }
}
