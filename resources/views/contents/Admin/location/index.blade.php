@extends('main')

@section('title', 'Lokasi')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Lokasi /</span> List</h4>

<div class="card">
    <h5 class="card-header"> Data Lokasi
        <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary"
                    onclick="window.location.href='{{ route('lokasi.create') }}'">Tambah Lokasi</button>
            </div>
        </div>
    </h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($locations as $location)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->address }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('lokasi.edit', $location->id) }}"><i
                                        class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="{{ route('lokasi.destroy', $location->id) }}"><i
                                        class="bx bx-trash me-2"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
