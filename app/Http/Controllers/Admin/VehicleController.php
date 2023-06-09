<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return view('contents.Admin.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contents.Admin.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'model' => ['required', 'string'],
            'license_plate' => ['required', 'string'],
            'fuel_consumption' => ['required', 'integer'],
            'maintenance_schedule' => ['required', 'date', 'after_or_equal:' . Carbon::now()->format('Y-m-d')],
            'status' => ['required', 'string'],
        ], [
            'type.required' => 'Tipe kendaraan harus diisi.',
            'type.string' => 'Tipe kendaraan harus berupa string.',
            'model.required' => 'Model kendaraan harus diisi.',
            'model.string' => 'Model kendaraan harus berupa string.',
            'license_plate.required' => 'Plat nomor kendaraan harus diisi.',
            'license_plate.string' => 'Plat nomor kendaraan harus berupa string.',
            'fuel_consumption.required' => 'Konsumsi bahan bakar kendaraan harus diisi.',
            'fuel_consumption.integer' => 'Konsumsi bahan bakar kendaraan harus berupa angka.',
            'maintenance_schedule.required' => 'Jadwal perawatan kendaraan harus diisi.',
            'maintenance_schedule.date' => 'Jadwal perawatan kendaraan harus berupa tanggal.',
            'maintenance_schedule.after_or_equal' => 'Jadwal perawatan kendaraan harus setelah atau sama dengan hari ini.',
            'status.required' => 'Status kendaraan harus diisi.',
            'status.string' => 'Status kendaraan harus berupa string.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        Vehicle::create([
            'type' => $request->type,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'fuel_consumption' => $request->fuel_consumption,
            'maintenance_schedule' => $request->maintenance_schedule,
            'status' => $request->status,
        ]);

        return redirect()->route('kendaraan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->usage = $vehicle->orders()->whereYear('created_at', Carbon::now()->format('Y'))->get()->groupBy(function ($order) {
            return Carbon::parse($order->date)->format('F');
        })->map(function ($orders) {
            return $orders->count();
        });

        $vehicle->maintenance_days = Carbon::parse($vehicle->maintenance_schedule)->diffInDays(Carbon::now());

        return view('contents.Admin.vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('contents.Admin.vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'model' => ['required', 'string'],
            'license_plate' => ['required', 'string'],
            'fuel_consumption' => ['required', 'integer'],
            'maintenance_schedule' => ['required', 'date', 'after_or_equal:' . Carbon::now()->format('Y-m-d')],
            'status' => ['required', 'string'],
        ], [
            'type.required' => 'Tipe kendaraan harus diisi.',
            'type.string' => 'Tipe kendaraan harus berupa string.',
            'model.required' => 'Model kendaraan harus diisi.',
            'model.string' => 'Model kendaraan harus berupa string.',
            'license_plate.required' => 'Plat nomor kendaraan harus diisi.',
            'license_plate.string' => 'Plat nomor kendaraan harus berupa string.',
            'fuel_consumption.required' => 'Konsumsi bahan bakar kendaraan harus diisi.',
            'maintenance_schedule.required' => 'Jadwal perawatan kendaraan harus diisi.',
            'maintenance_schedule.date' => 'Jadwal perawatan kendaraan harus berupa tanggal.',
            'maintenance_schedule.after_or_equal' => 'Jadwal perawatan kendaraan harus setelah atau sama dengan hari ini.',
            'status.required' => 'Status kendaraan harus diisi.',
            'status.string' => 'Status kendaraan harus berupa string.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        Vehicle::findOrFail($id)->update([
            'type' => $request->type,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'fuel_consumption' => $request->fuel_consumption,
            'maintenance_schedule' => $request->maintenance_schedule,
            'status' => $request->status,
        ]);

        return redirect()->route('kendaraan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vehicle::findOrFail($id)->delete();

        return redirect()->route('kendaraan.index');
    }
}
