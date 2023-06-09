@extends('main')

@section('title', 'Kendaraan')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan /</span> List</h4>

<div class="card">
    <h5 class="card-header">Kendaraan
        <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary"
                    onclick="window.location.href='{{ route('kendaraan.create') }}'">Tambah Kendaraan</button>
            </div>
        </div>
    </h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th>Model</th>
                    <th>Plat Nomor</th>
                    <th>Jadwal Perawatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->license_plate }}</td>
                    <td>{{ $vehicle->maintenance_schedule }}</td>
                    <td>
                        @if ($vehicle->status == "Tersedia")
                        <span class="badge bg-success">Tersedia</span>
                        @elseif ($vehicle->status == "Digunakan")
                        <span class="badge bg-danger">Digunakan</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('kendaraan.show', $vehicle->id) }}"><i
                                        class="bx bx-show-alt me-2"></i>
                                    Show</a>
                                <a class="dropdown-item" href="{{ route('kendaraan.edit', $vehicle->id) }}"><i
                                        class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="{{ route('kendaraan.destroy', $vehicle->id) }}"><i
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
