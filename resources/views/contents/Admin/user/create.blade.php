@extends('main')

@section('title', 'Tambah User')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Tambah User</h4>
<div class="card mb-4">
    <h5 class="card-header">Tambah User</h5>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" aria-label="Default select example" name="role" required>
                        <option value="" selected>Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Approval">Approval</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password12">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="basic-default-password12" name="password" required
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="basic-default-password2" />
                            <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex mt-3 justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button"
                        onclick="window.history.back()">Kembali</button>
                    <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
