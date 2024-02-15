<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //index
    public function index(Request $request)
    {
        //get all users with pagination
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')
                      ->orWhere('email', 'like', '%'. $name . '%');
            })

            ->paginate(10);
        return view('pages.users.index', compact('users'));
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
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        \App\Models\User::create($data);

        return redirect()->route('users.index')->with('success', 'User successfully created');

    }

    // show
    public function show($id)
    {
        return view('pages.users.show');
    }

    // edit
    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'roles' => 'required|in:admin,staff,user',
        ]);

        // update the request...
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->save();

         //if password is not empty
         if ($request->password){
            $user->password = Hash::make($request->password);
            $user->save();
         }

         return redirect()->route('users.index')->with('success', 'user Update successfully');
    }
        // destroy
         public function destroy($id)
    {
        // delete the request...
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');

    }
}

