@extends('main')

@section('title', 'Pesan Baru')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pesanan /</span> Pesan Baru</h4>
<div class="card mb-4">
    <h5 class="card-header">Pesan</h5>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form action="{{ route('pesanan.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="model" class="form-label">Model</label>
                    <select class="form-select" id="model" aria-label="Default select example" name="model" required>
                        <option value="" selected>Pilih Model</option>
                        @foreach ($vehicles as $vehicle)
                        @if ($vehicle->status == 'Tersedia')
                        <option value="{{ $vehicle->id }}">{{ $vehicle->model }} ({{ $vehicle->type }})</option>
                        @else
                        <option value="{{ $vehicle->id }}" disabled>{{ $vehicle->model }} (Tidak Tersedia)</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="dari">Dari</label>
                    <select class="form-select" id="dari" aria-label="Default select example" name="from" required>
                        <option value="" selected>Pilih Lokasi</option>
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="tujuan">Tujuan</label>
                    <select class="form-select" id="tujuan" aria-label="Default select example" name="destination" required>
                        <option value="" selected>Pilih Lokasi</option>
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="driver" class="form-label">Driver</label>
                    <select class="form-select" id="driver" aria-label="Default select example" name="driver" required>
                        <option value="" selected>Pilih Driver</option>
                        @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="approver" class="form-label">Approver</label>
                    <select class="form-select" id="approver" aria-label="Default select example" name="approver"
                        required>
                        <option value="" selected>Pilih Approver</option>
                        @foreach ($users as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->username }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="approver2" class="form-label">Approver 2</label>
                    <select class="form-select" id="approver2" aria-label="Default select example" name="approver2"
                        required>
                        <option value="" selected>Pilih Approver 2</option>
                        @foreach ($users as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->username }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="20" name="date" required />
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
