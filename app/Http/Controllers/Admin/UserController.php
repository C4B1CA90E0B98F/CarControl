<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('contents.Admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contents.Admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'role' => ['required', 'string'],
            'username' => ['required', 'unique:users,username', 'string'],
            'email' => ['required', 'unique:users,email', 'email:rfc,dns'],
            'password' => ['required', 'string']
        ], [
            'role.required' => 'Role harus diisi.',
            'role.string' => 'Role harus berupa string.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.string' => 'Username harus berupa string.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.email' => 'Email harus berupa email.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa string.'
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->with('error', $Validator->errors()->first());
        }

        User::create([
            'role' => $request->role,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('user.index');
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
        $user = User::find($id);

        return view('contents.Admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Validator = Validator::make($request->all(), [
            'role' => ['required', 'string'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'string']
        ], [
            'role.required' => 'Role harus diisi.',
            'role.string' => 'Role harus berupa string.',
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa email.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa string.'
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->with('error', $Validator->errors()->first());
        }

        $user = User::find($id);

        $user->update([
            'role' => $request->role,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('user.index');
    }
}
