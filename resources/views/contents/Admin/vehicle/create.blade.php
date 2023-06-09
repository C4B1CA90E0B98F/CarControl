@extends('main')

@section('title', 'Tambah Kendaraan')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan /</span> Tambah Kendaraan</h4>
<div class="card mb-4">
    <h5 class="card-header">Tambah Kendaraan</h5>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form action="{{ route('kendaraan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" name="model" id="model" placeholder="Masukkan Model Kendaraan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type">Tipe</label>
                    <select class="form-select" name="type" id="type" required>
                        <option value="">Pilih Tipe</option>
                        <option value="Orang">Orang</option>
                        <option value="Barang">Barang</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomor_plat">Plat Nomor</label>
                    <input type="text" class="form-control" name="license_plate" id="nomor_plat" placeholder="Masukkan Plat Nomor Kendaraan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="komsumsi_bbm">Konsumsi BBM</label>
                    <input type="number" class="form-control" name="fuel_consumption" id="komsumsi_bbm" placeholder="Masukkan Konsumsi BBM Kendaraan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="maintenance_schedule">Jadwal Perawatan</label>
                    <input type="date" class="form-control" name="maintenance_schedule" id="maintenance_schedule" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status">Status</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Digunakan">Digunakan</option>
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
