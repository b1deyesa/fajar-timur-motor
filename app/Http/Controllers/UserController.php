<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'users' => User::whereNot('id', Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate data
        $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama admin tidak boleh kosong',
        ]);

        // Change password
        if($request->password == null) {
            $request['password'] = $user->password;
        } else {
            $request['password'] = bcrypt($request->password);
        }
        
        // Update data
        $user->update($request->all());

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data Admin ('. $user->username .')'
        ]);

        return redirect()->route('user.index')->with('message','Data Admin ('. $user->username .') Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
