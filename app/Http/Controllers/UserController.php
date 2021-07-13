<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        $user = User::get();
        return view('pages.developer.user', compact('user'));
    }

   
    public function create()
    {
        return view('pages.developer.userAdd');
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'level' => 'required',
            'password' => 'required',
        ]);

        $user = New User;
        $user->nama_lengkap = $request->get('nama_lengkap');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->no_telepon = $request->get('no_telepon');
        $user->level = $request->get('level');
        $user->password = $request->get('password');

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Employee Successfully Added');


    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('pages.developer.userEdit', compact('user'));
    }

    
    public function update(Request $request, $id)
    {
         $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'level' => 'required',
            'password' => 'nullable',
        ]);

        $user = User::where('id', $id)->first();
        $user->nama_lengkap = $request->get('nama_lengkap');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->no_telepon = $request->get('no_telepon');
        $user->level = $request->get('level');

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Employee Successfully Edit');
    }

    
    public function destroy($id)
    {
        //
    }
}
