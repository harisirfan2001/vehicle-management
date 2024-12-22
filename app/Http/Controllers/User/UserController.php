<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })->get(); 
    
        return view('User.UserManagement.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $roles = Role::where('name', '!=', 'superadmin')->get();
        return view('User.UserManagement.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
  

public function store(Request $request)
{

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'role' => 'required|exists:roles,id',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $role = Role::findOrFail($request->role);
    $user->assignRole($role);
    
    return redirect()->route('manage-user.index')->with('success', 'User created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); 
        $roles = Role::where('name', '!=', 'superadmin')->get();
        return view('User.UserManagement.update', compact('user', 'roles')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8',
        'role' => 'nullable|exists:roles,id',
    ]);

    $user = User::findOrFail($id);

    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    if ($request->filled('role')) {
        $role = Role::findOrFail($request->input('role'));
        $user->syncRoles($role);
    }

    $user->save();

    return redirect()->route('manage-user.index')->with('success', 'User updated successfully.');
}
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); 
        $user->delete();
        return redirect()->route('manage-user.index')->with('success', 'User deleted successfully!');
    }
   
    public function toggle($id)
{
    $user = User::findOrFail($id);
    $user->active = !$user->active;
    $user->save();

    return redirect()->route('manage-user.index')->with('success', 'User status updated successfully.');
}
}
