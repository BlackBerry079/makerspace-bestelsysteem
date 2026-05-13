<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // SHOW ALL USERS - Display list view
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', ['users' => $users]);
    }

    // SHOW SINGLE USER - Display detail view
    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    // CREATE USER - Display create form
    public function create()
    {
        $roles = \App\Models\Role::all(); // Get all roles for dropdown
        return view('users.create', ['roles' => $roles]);
    }

    // STORE USER - Save to database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/@mydavinci\.nl$/|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'active' => 'required|boolean',
            'role_id' => 'required|integer|exists:role,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => $request->active,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.show', $user->id)
            ->with('success', 'User created successfully');
    }

    // EDIT USER - Display edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = \App\Models\Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    // UPDATE USER - Save changes to database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/@mydavinci\.nl$/|unique:user,email,' . $id,
            'active' => 'required|boolean',
            'role_id' => 'required|integer|exists:role,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'active' => $request->active,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.show', $user->id)
            ->with('success', 'User updated successfully');
    }

    // DELETE USER
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
