<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Drivers = Driver::all();

        return view('contents.Admin.driver.index', compact('Drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contents.Admin.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ], [
            'name.required' => 'Nama driver harus diisi.',
            'name.string' => 'Nama driver harus berupa string.',
            'status.required' => 'Status driver harus diisi.',
            'status.string' => 'Status driver harus berupa string.',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->with('error', $Validator->errors()->first());
        }

        Driver::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('user.driver.index');
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
        return view('contents.Admin.driver.edit', [
            'Driver' => Driver::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ], [
            'name.required' => 'Nama driver harus diisi.',
            'name.string' => 'Nama driver harus berupa string.',
            'status.required' => 'Status driver harus diisi.',
            'status.string' => 'Status driver harus berupa string.',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->with('error', $Validator->errors()->first());
        }

        $Driver = Driver::findOrFail($id);

        $Driver->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('user.driver.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Driver = Driver::findOrFail($id);

        $Driver->delete();

        return redirect()->route('user.driver.index');
    }
}
