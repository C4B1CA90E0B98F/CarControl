@extends('main')

@section('title', 'Edit Kendaraan')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan /</span> Edit</h4>
<div class="card mb-4">
    <h5 class="card-header">Edit Kendaraan</h5>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form action="{{ route('kendaraan.update', $vehicle->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="{{ $vehicle->model }}" required>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Tipe</label>
                    <select class="form-select" name="type" id="type" required>
                        <option value="Orang" @if ($vehicle->type == 'Orang') selected @endif>Orang</option>
                        <option value="Barang" @if ($vehicle->type == 'Barang') selected @endif>Barang</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="plat" class="form-label">Plat Nomor</label>
                    <input type="text" class="form-control" id="plat" name="license_plate" value="{{ $vehicle->license_plate }}" required>
                </div>
                <div class="col-md-6">
                    <label for="komsumsi_bbm" class="form-label">Konsumsi BBM</label>
                    <input type="number" class="form-control" id="komsumsi_bbm" name="fuel_consumption" value="{{ $vehicle->fuel_consumption }}" required>
                </div>
                <div class="col-md-6">
                    <label for="maintenance_schedule" class="form-label">Jadwal Perawatan</label>
                    <input type="date" class="form-control" id="maintenance_schedule" name="maintenance_schedule" value="{{ $vehicle->maintenance_schedule }}" required>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" aria-label="Default select example" name="status" required>
                        @if ($vehicle->status == 'Tersedia')
                        <option value="Tersedia" selected>Tersedia</option>
                        <option value="Digunakan">Digunakan</option>
                        @else
                        <option value="Tersedia">Tersedia</option>
                        <option value="Digunakan" selected>Digunakan</option>
                        @endif
                    </select>
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
