@extends('main')

@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome {{ Auth::user()->username }}! 🎉</h5>
                        <p class="mb-4">
                            Semoga harimu menyenangkan!
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                            alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png') }}"
                            data-app-light-img="illustrations/man-with-laptop-light.png') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('Admin')
    <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="bx bx-user"></i></span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('user.index') }}">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Users</span>
                        <h3 class="card-title mb-2">{{ $totalUser }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-33 col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="bx bx-car"></i></span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('kendaraan.index') }}">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Kendaraan</span>
                        <h3 class="card-title mb-2">{{ $totalVehicle }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-33 col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="bx bx-map"></i></span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('lokasi.index') }}">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Lokasi</span>
                        <h3 class="card-title mb-2">{{ $totalLocation }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-33 col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="bx bxs-calendar-event"></i></span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('pesanan.index') }}">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Booking</span>
                        <h3 class="card-title mb-2">{{ $totalOrder }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <h5 class="card-header"> <i class="bx bx-calendar me-2"></i> Log Aktivitas</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th>Diubah</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($logs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->causer->username }}</td>
                    <td>{{ $log->log_name }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                    <td>{{ $log->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endcan

@can('Approver')
<div class="card">
    <h5 class="card-header">Booking</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Dari</th>
                    <th>Tujuan</th>
                    <th>Driver</th>
                    <th>Approver</th>
                    <th>Approver 2</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($approvals as $order)
                @if ($order->approver2->user->username == Auth::user()->username)
                @if ($order->approver->status == "Disetujui")
                <tr>
                    <td>{{ $order->vehicle->model }} ({{ $order->vehicle->type }})</td>
                    <td>{{ $order->from->name }}</td>
                    <td>{{ $order->destination->name }}</td>
                    <td>{{ $order->driver->name }}</td>
                    <td>
                        @if ($order->approver->status == "Menunggu")
                        <span class="badge bg-warning">{{ $order->approver->user->username }}</span>
                        @elseif ($order->approver->status == "Disetujui")
                        <span class="badge bg-success">{{ $order->approver->user->username }}</span>
                        @elseif ($order->approver->status == "Ditolak")
                        <span class="badge bg-danger">{{ $order->approver->user->username }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($order->approver2->status == "Menunggu")
                        <span class="badge bg-warning">{{ $order->approver2->user->username }}</span>
                        @elseif ($order->approver2->status == "Disetujui")
                        <span class="badge bg-success">{{ $order->approver2->user->username }}</span>
                        @elseif ($order->approver2->status == "Ditolak")
                        <span class="badge bg-danger">{{ $order->approver2->user->username }}</span>
                        @endif
                    </td>
                    <td>{{ $order->date }}</td>
                    <td>
                        @if ($order->status == "Menunggu")
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif ($order->status == "Disetujui")
                        <span class="badge bg-success">Disetujui</span>
                        @elseif ($order->status == "Ditolak")
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if ($order->status == "Menunggu")
                        {{-- <a href="{{ route('approval.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        --}}
                        <a href="{{ route('approval.approve', $order->id) }}" class="btn btn-success btn-sm">Terima</a>
                        <a href="{{ route('approval.reject', $order->id) }}" class="btn btn-danger btn-sm">Tolak</a>
                        @endif
                    </td>
                </tr>
                @endif
                @elseif ($order->approver->user->username == Auth::user()->username)
                <tr>
                    <td>{{ $order->vehicle->model }} ({{ $order->vehicle->type }})</td>
                    <td>{{ $order->from->name }}</td>
                    <td>{{ $order->destination->name }}</td>
                    <td>{{ $order->driver->name }}</td>
                    <td>
                        @if ($order->approver->status == "Menunggu")
                        <span class="badge bg-warning">{{ $order->approver->user->username }}</span>
                        @elseif ($order->approver->status == "Disetujui")
                        <span class="badge bg-success">{{ $order->approver->user->username }}</span>
                        @elseif ($order->approver->status == "Ditolak")
                        <span class="badge bg-danger">{{ $order->approver->user->username }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($order->approver2->status == "Menunggu")
                        <span class="badge bg-warning">{{ $order->approver2->user->username }}</span>
                        @elseif ($order->approver2->status == "Disetujui")
                        <span class="badge bg-success">{{ $order->approver2->user->username }}</span>
                        @elseif ($order->approver2->status == "Ditolak")
                        <span class="badge bg-danger">{{ $order->approver2->user->username }}</span>
                        @endif
                    </td>
                    <td>{{ $order->date }}</td>
                    <td>
                        @if ($order->approver->status == "Menunggu")
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif ($order->approver->status == "Disetujui" && $order->approver2->status == "Menunggu")
                        <span class="badge bg-primary">Menunggu</span>
                        @elseif ($order->approver->status == "Disetujui" && $order->approver2->status == "Disetujui")
                        <span class="badge bg-success">Disetujui</span>
                        @elseif ($order->approver->status == "Ditolak" || $order->approver2->status == "Ditolak")
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if ($order->approver->status == "Disetujui" && $order->approver2->status == "Disetujui" &&
                        $order->approver->status == "Ditolak")
                        <a href="" class="btn btn-primary btn-sm" disabled>Edit</a>
                        <a href="" class="btn btn-success btn-sm" disabled>Terima</a>
                        <a href="" class="btn btn-danger btn-sm" disabled>Tolak</a>
                        @elseif ($order->approver->status == "Menunggu")
                        <a href="{{ route('approval.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('approval.approve', $order->id) }}" class="btn btn-success btn-sm">Terima</a>
                        <a href="{{ route('approval.reject', $order->id) }}" class="btn btn-danger btn-sm">Tolak</a>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endcan
@endsection

@section('js')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection
