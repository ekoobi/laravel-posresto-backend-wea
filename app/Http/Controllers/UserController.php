<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //index
    public function index()
    {
        return view('pages.users.index');
    }

    //create
    public function create()
    {
        return view('pages.users.create');
    }
    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'roles' => 'required|in:admin,staff,user',
        ]);

            // store the request...
            // $user = new Users;
            // $user->name = $request->name;
            // $user->email = $request->email;
            // $user->password= Hash::make($request->password);
            // $user->roles = $request->roles;
            // $user->save();

            // return redirect()->route('users.index')->swith('success', 'User created successfully');

    }

    // show
    public function show($id)
    {
        return view('pages.users.show');
    }

    // edit
    public function edit($id)
    {
        return view('pages.users.edit');
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|in:admin,staff,user',
        ]);

        // update the request...
        // $user = User::find($id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->roles = $request-roles;
        // $user->save();

        // return redirect()->route('users.index')->with('success', 'User Update successfully');

    }
}
