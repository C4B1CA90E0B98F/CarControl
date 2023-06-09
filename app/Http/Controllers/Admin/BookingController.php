<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PesananExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Approval;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Orders = Order::where('user_id', auth()->user()->id)->get();

        return view('contents.Admin.booking.index', compact('Orders'));
    }

    public function export()
    {
        return Excel::download(new PesananExport, 'pesanan.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'Approver')->get();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $locations = Location::all();

        return view('contents.Admin.booking.create', compact('users', 'vehicles', 'drivers', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'model' => 'required|exists:vehicles,id',
            'from' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'driver' => 'required|exists:drivers,id',
            'approver' => 'required|exists:users,id',
            'approver2' => 'required|exists:users,id',
            'date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')]
        ], [
            'model.required' => 'Kolom model harus diisi.',
            'model.exists' => 'Model tidak ditemukan.',
            'from.required' => 'Kolom lokasi asal harus diisi.',
            'from.exists' => 'Lokasi asal tidak ditemukan.',
            'destination.required' => 'Kolom lokasi tujuan harus diisi.',
            'destination.exists' => 'Lokasi tujuan tidak ditemukan.',
            'driver.required' => 'Kolom driver harus diisi.',
            'driver.exists' => 'Driver tidak ditemukan.',
            'approver.required' => 'Kolom approver 1 harus diisi.',
            'approver.exists' => 'Approver 1 tidak ditemukan.',
            'approver2.required' => 'Kolom approver 2 harus diisi.',
            'approver2.exists' => 'Approver 2 tidak ditemukan.',
            'date.required' => 'Kolom tanggal harus diisi.',
            'date.date' => 'Kolom tanggal harus berupa tanggal.',
            'date.after_or_equal' => 'Kolom tanggal harus lebih dari atau sama dengan tanggal sekarang.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        if ($request->from == $request->destination) {
            return redirect()->back()->with('error', 'Lokasi asal dan tujuan tidak boleh sama.');
        }

        if ($request->approver == $request->approver2) {
            return redirect()->back()->with('error', 'Approver 1 dan Approver 2 tidak boleh sama.');
        }

        $Approver = Approval::create([
            'user_id' => $request->approver,
        ]);

        $Approver2 = Approval::create([
            'user_id' => $request->approver2,
        ]);

        Order::create([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $request->model,
            'driver_id' => $request->driver,
            'approver_id' => $Approver->id,
            'approver2_id' => $Approver2->id,
            'from_id' => $request->from,
            'destination_id' => $request->destination,
            'date' => $request->date,
        ]);

        return redirect()->route('pesanan.index');
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
        $order = Order::where('id', $id)->firstOrFail();
        $users = User::where('role', 'Approver')->get();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $locations = Location::all();

        return view('contents.Admin.booking.edit', compact('order', 'users', 'vehicles', 'drivers', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'model' => 'required|exists:vehicles,id',
            'from' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'driver' => 'required|exists:drivers,id',
            'approver' => 'required|exists:users,id',
            'approver2' => 'required|exists:users,id',
            'date' => 'required',
        ], [
            'model.required' => 'Kolom model harus diisi.',
            'model.exists' => 'Model tidak ditemukan.',
            'from.required' => 'Kolom lokasi asal harus diisi.',
            'from.exists' => 'Lokasi asal tidak ditemukan.',
            'destination.required' => 'Kolom lokasi tujuan harus diisi.',
            'destination.exists' => 'Lokasi tujuan tidak ditemukan.',
            'driver.required' => 'Kolom driver harus diisi.',
            'driver.exists' => 'Driver tidak ditemukan.',
            'approver.required' => 'Kolom approver 1 harus diisi.',
            'approver.exists' => 'Approver 1 tidak ditemukan.',
            'approver2.required' => 'Kolom approver 2 harus diisi.',
            'approver2.exists' => 'Approver 2 tidak ditemukan.',
            'date.required' => 'Kolom tanggal harus diisi.',
        ]);

        if ($request->from == $request->destination) {
            return redirect()->back()->with('error', 'Lokasi asal dan tujuan tidak boleh sama.');
        }

        if ($request->approver == $request->approver2) {
            return redirect()->back()->with('error', 'Approver 1 dan Approver 2 tidak boleh sama.');
        }

        $order = Order::where('id', $id)->firstOrFail();
        
        $order->update([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $request->model,
            'driver_id' => $request->driver,
            'from_id' => $request->from,
            'destination_id' => $request->destination,
            'date' => $request->date,
        ]);

        Approval::where('id', $order->approver_id)->update([
            'user_id' => $request->approver,
        ]);

        Approval::where('id', $order->approver2_id)->update([
            'user_id' => $request->approver2,
        ]);

        return redirect()->route('pesanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $order->delete();

        return redirect()->route('pesanan.index');
    }
}
