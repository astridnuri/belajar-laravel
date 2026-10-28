<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="User Management - PPKD Sticker";
        $users= User::orderBy('id','desc')->get();
        return view('admin.user.index', compact('title','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah User - PPKD Sticker";
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);
        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>$validated['password']
        ]);
        return redirect()->route('admin.user.index')
            ->with('success','Data user berhasil dibuat!');
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
    public function edit(User $user)
    {
        //
        // $user = User::findOrFail($id)
        $title='Edit User - PPKD Sticker';
        return view('admin.user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|min:8'
        ]);

        $user->name=$validated['name'];
        $user->email=$validated['email'];
        if ($request->filled('password')) {
            $user->password=$validated['password'];
        }
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'Data user updated!');
    }

    /**
     * Delete the specified resource from storage.
     */
    public function destroy(string $id)
    {

        User::where('id',$id)->delete();
        return redirect()->route('admin.user.index');
    }
}
