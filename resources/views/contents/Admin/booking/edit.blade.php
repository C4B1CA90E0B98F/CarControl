@extends('main')

@section('title', 'Edit Pesanan')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pesanan /</span> Edit</h4>
<div class="card mb-4">
    <h5 class="card-header">Pesan</h5>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form action="{{ route('pesanan.update', $order->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="model" class="form-label">Model</label>
                    <select class="form-select" id="model" aria-label="Default select example" name="model" required>
                        <option value="" selected>Pilih Model</option>
                        @foreach ($vehicles as $vehicle)
                        @if ($vehicle->id == $order->vehicle_id)
                        <option value="{{ $vehicle->id }}" selected>{{ $vehicle->model }} ({{ $vehicle->type }})</option>
                        @else
                        @if ($vehicle->status == 'Tersedia')
                        <option value="{{ $vehicle->id }}">{{ $vehicle->model }} ({{ $vehicle->type }})</option>
                        @else
                        <option value="{{ $vehicle->id }}" disabled>{{ $vehicle->model }} (Tidak Tersedia)</option>
                        @endif
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="dari">Dari</label>
                    <select class="form-select" id="dari" aria-label="Default select example" name="from" required>
                        @foreach ($locations as $location)
                        @if ($location->id == $order->from_id)
                        <option value="{{ $location->id }}" selected>{{ $location->name }}</option>
                        @else
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="tujuan">Tujuan</label>
                    <select class="form-select" id="tujuan" aria-label="Default select example" name="destination" required>
                        @foreach ($locations as $location)
                        @if ($location->id == $order->destination_id)
                        <option value="{{ $location->id }}" selected>{{ $location->name }}</option>
                        @else
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="driver" class="form-label">Driver</label>
                    <select class="form-select" id="driver" aria-label="Default select example" name="driver" required>
                        @foreach ($drivers as $driver)
                        @if ($driver->id == $order->driver_id)
                        <option value="{{ $driver->id }}" selected>{{ $driver->name }}</option>
                        @else
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="approver" class="form-label">Approver</label>
                    <select class="form-select" id="approver" aria-label="Default select example" name="approver"
                        required>
                        @foreach ($users as $approver)
                        @if ($approver->id == $order->approver->user->id)
                        <option value="{{ $approver->id }}" selected>{{ $approver->username }}</option>
                        @else
                        <option value="{{ $approver->id }}">{{ $approver->username }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="approver2" class="form-label">Approver 2</label>
                    <select class="form-select" id="approver2" aria-label="Default select example" name="approver2"
                        required>
                        @foreach ($users as $approver)
                        @if ($approver->id == $order->approver2->user->id)
                        <option value="{{ $approver->id }}" selected>{{ $approver->username }}</option>
                        @else
                        <option value="{{ $approver->id }}">{{ $approver->username }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="20" name="date" value="{{ $order->date }}" required>
                </div>

                <div class="d-grid gap-2 d-md-flex mt-3 justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button" onclick="window.history.back()">Kembali</button>
                    <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
