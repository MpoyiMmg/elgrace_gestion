<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    
        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678'),  
        ]);
    
    
        // Redirection avec succès
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }
    

    

    /**
     * 
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    { 
        $user = User::find($id);
        
        $roles = Role::where('name', '<>', strtolower('admin'))->get();
        
        $successMessage = $request->session()->get('success');
        $errorMessage = $request->session()->get('error');
        
        return view('pages.users.edit', compact('user', 'roles', 'successMessage', 'errorMessage'));
    }
    
    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
    //dd($request->all());
    $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if(!is_null($request->role_id)) {
            $role = Role::find($request->role_id);
            $user->syncRoles([]);
            $user->assignRole($role);
        }
    return to_route('users.edit', $user->id)->with('success', 'Utilisateur modifié avec succès!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function changePasswordForm()
    {
        return view('pages.users.change-password');
    }

    // Met à jour le mot de passe
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'L\'ancien mot de passe est incorrect.']);
        }
    
        if ($request->current_password === $request->new_password) {
            return back()->withErrors(['new_password' => 'Le nouveau mot de passe ne peut pas être identique à l\'ancien.']);
        }
    
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
    
        return redirect()->route('password.changeuser')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}    
