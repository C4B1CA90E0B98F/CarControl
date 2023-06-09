<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();

        return view('contents.Admin.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contents.Admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Nama lokasi harus diisi',
            'address.required' => 'Alamat harus diisi',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }

        Location::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('lokasi.index');
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
        $location = Location::find($id);

        return view('contents.Admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Nama lokasi harus diisi',
            'address.required' => 'Alamat harus diisi',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }

        $location = Location::find($id);

        $location->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('lokasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::find($id);

        $location->delete();

        return redirect()->route('lokasi.index');
    }
}
