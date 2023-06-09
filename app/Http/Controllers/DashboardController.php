<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Driver;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $totalUser = User::all()->count();
            $totalVehicle = Vehicle::all()->count();
            $totalLocation = Driver::all()->count();
            $totalOrder = Order::all()->count();
            $logs = Activity::latest()->paginate(10);

            return view('contents.dashboard', compact('totalUser', 'totalVehicle', 'totalLocation', 'totalOrder', 'logs'));
        } elseif (Auth::user()->role == 'Approver') {
            $userId = Auth::id();

            $list = Auth::user()->approvals;

            $approval = Order::join('approvals', 'orders.approver_id', '=', 'approvals.id')
                ->where('approvals.user_id', $userId)
                ->get();

            $approval2 = Order::join('approvals', 'orders.approver2_id', '=', 'approvals.id')
                ->where('approvals.user_id', $userId)->get();

            $orders = Order::all();

            $result = Order::join('approvals', 'orders.approver_id', '=', 'approvals.id')
                ->where('approvals.user_id', $userId)
                ->get();

            $approvals = $approval->merge($approval2);

            return view('contents.dashboard', compact('approval', 'approval2', 'approvals'));
        }
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // jika Order error
        if (Order::where('approver_id', $id)->get()->count() != 0) {
            $orders = Order::where('approver_id', $id)->get()[0];
        } else {
            $orders = Order::where('approver2_id', $id)->get()[0];
        }
        return view('contents.Approver.edit', [
            'orders' => $orders,
            'approval' => Approval::findOrFail($id),
            'users' => User::all(),
            'vehicles' => Vehicle::all(),
            'drivers' => Driver::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Validator = Validator::make($request->all(), [
            'model' => 'required|exists:vehicles,id',
            'driver' => 'required|exists:drivers,id',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator);
        }

        $approval = Approval::findOrFail($id);
        $approval->update([
            'vehicle_id' => $request->model,
            'driver_id' => $request->driver,
        ]);

        return redirect()->route('dashboard');
    }

    function approve(Request $request, string $id)
    {
        $approval = Approval::findOrFail($id);
        $approval->update([
            'status' => 'Disetujui',
        ]);

        return redirect()->route('dashboard');
    }

    function reject(Request $request, string $id)
    {
        $approval = Approval::findOrFail($id);
        $approval->update([
            'status' => 'Ditolak',
        ]);

        return redirect()->route('dashboard');
    }
}
