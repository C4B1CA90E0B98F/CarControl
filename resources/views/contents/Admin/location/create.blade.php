@extends('main')

@section('title', 'Tambah Lokasi')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Lokasi /</span> Tambah Lokasi</h4>
<div class="card mb-4">
    <h5 class="card-header">Tambah Lokasi</h5>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form action="{{ route('lokasi.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
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
