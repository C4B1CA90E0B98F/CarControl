@extends('main')

@section('title', 'Pesanan')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pesanan /</span> History</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Pesanan
        <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('pesanan.export') }}'">Export</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('pesanan.create') }}'">Pesan Baru</button>
            </div>
        </div>
    </h5>
    {{-- add 2 button export and pesan baru in right --}}
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kendaraan</th>
                    <th>Dari</th>
                    <th>Tujuan</th>
                    <th>Driver</th>
                    <th>Approver</th>
                    <th>Approver 2</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($Orders as $Order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $Order->vehicle->model }} ({{ $Order->vehicle->type }})</td>
                    <td>{{ $Order->from->name }}</td>
                    <td>{{ $Order->destination->name }}</td>
                    <td>{{ $Order->driver->name }}</td>
                    @if ($Order->approver->status == "Menunggu")
                    <td><span class="badge bg-warning">{{ $Order->approver->user->username }}</span></td>
                    @elseif ($Order->approver->status == "Disetujui")
                    <td><span class="badge bg-success">{{ $Order->approver->user->username }}</span></td>
                    @elseif ($Order->approver->status == "Ditolak")
                    <td><span class="badge bg-danger">{{ $Order->approver->user->username }}</span></td>
                    @endif
                    @if ($Order->approver2->status == "Menunggu")
                    <td><span class="badge bg-warning">{{ $Order->approver2->user->username }}</span></td>
                    @elseif ($Order->approver2->status == "Disetujui")
                    <td><span class="badge bg-success">{{ $Order->approver2->user->username }}</span></td>
                    @elseif ($Order->approver2->status == "Ditolak")
                    <td><span class="badge bg-danger">{{ $Order->approver2->user->username }}</span></td>
                    @endif
                    <td>{{ $Order->date }}</td>
                    <td>
                        @if ($Order->approver->status == "Menunggu")
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif ($Order->approver->status == "Disetujui" && $Order->approver2->status == "Menunggu")
                        <span class="badge bg-primary">Menunggu</span>
                        @elseif ($Order->approver->status == "Disetujui" && $Order->approver2->status == "Disetujui")
                        <span class="badge bg-success">Disetujui</span>
                        @elseif ($Order->approver->status == "Ditolak" || $Order->approver2->status == "Ditolak")
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            @if ($Order->approver->status == "Menunggu")
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('pesanan.edit', $Order->id) }}"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="{{ route('pesanan.destroy', $Order->id) }}"><i class="bx bx-trash me-2"></i>
                                    Delete</a>
                            </div>
                            @elseif ($Order->approver->status == "Ditolak" || $Order->approver2->status == "Ditolak")
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" disabled>
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
                                    Delete</a>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
