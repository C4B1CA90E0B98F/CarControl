@extends('main')

@section('title', 'Detail Kendaraan')
@section('content')
<div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
            <h5 class="m-0 me-2">Statistik Kendaraan</h5>
            <small class="text-muted">{{ $vehicle->model }} ({{ $vehicle->license_plate }})</small>
        </div>
        <div class="dropdown">
            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                <a class="dropdown-item" href="{{ route('kendaraan.edit', $vehicle->id) }}"><i
                        class="bx bx-edit-alt me-2"></i>
                    Edit</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div id="PemakaianChart"></div>
        </div>
        <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-car"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">{{ $vehicle->model }}</h6>
                        <small class="text-muted">{{ $vehicle->type }}</small>
                    </div>
                    <div class="user-progress">
                        <small class="fw-semibold">{{ $vehicle->status }}</small>
                    </div>
                </div>
            </li>
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-car"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Plat Nomor</h6>
                        <small class="text-muted">{{ $vehicle->license_plate }}</small>
                    </div>
                    {{-- <div class="user-progress">
                        <small class="fw-semibold">{{ $vehicle->status }}</small>
                    </div> --}}
                </div>
            </li>
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class='bx bxs-car-battery'></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Konsumsi BBM</h6>
                        <small class="text-muted">{{ $vehicle->fuel_consumption }} Km/L</small>
                    </div>
                    <div class="user-progress">
                        <small class="fw-semibold">{{ $vehicle->fuel_type }}</small>
                    </div>
                </div>
            </li>
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Jadwal Perawatan</h6>
                        <small class="text-muted">{{ $vehicle->maintenance_schedule }}</small>
                    </div>
                    <div class="user-progress">
                        <small class="fw-semibold">{{ $vehicle->maintenance_days }} Hari lagi</small>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('js')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<script>
    'use strict';

    (function () {
        let cardColor, headingColor, axisColor, shadeColor, borderColor;

        cardColor = config.colors.white;
        headingColor = config.colors.headingColor;
        axisColor = config.colors.axisColor;
        borderColor = config.colors.borderColor;

        // Income Chart - Area chart
        // --------------------------------------------------------------------
        const PemakaianChartEl = document.querySelector('#PemakaianChart'),
            PemakaianChartConfig = {
                series: [{
                    name: 'Pemakaian Kendaraan',
                    data: @json($vehicle->usage->values()->toArray())
                }],
                chart: {
                    height: 250,
                    width: '380%',
                    parentHeightOffset: 0,
                    parentWidthOffset: 0,
                    toolbar: {
                        show: false
                    },
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                }, 
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                legend: {
                    show: false
                },
                markers: {
                    size: 6,
                    colors: 'transparent',
                    strokeColors: 'transparent',
                    strokeWidth: 4,
                    discrete: [{
                        fillColor: config.colors.white,
                        seriesIndex: 0,
                        dataPointIndex: 7,
                        strokeColor: config.colors.primary,
                        strokeWidth: 2,
                        size: 6,
                        radius: 8
                    }],
                    hover: {
                        size: 7
                    }
                },
                colors: [config.colors.primary],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.6,
                        opacityFrom: 0.5,
                        opacityTo: 0.25,
                        stops: [0, 95, 100]
                    }
                },
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 3,
                    padding: {
                        top: -20,
                        bottom: -8,
                        left: -10,
                        right: 8
                    }
                },
                xaxis: {
                    categories: @json($vehicle->usage->keys()->toArray()),
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: true,
                        style: {
                            fontSize: '13px',
                            colors: axisColor
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false
                    },
                    min: 10,
                    max: 50,
                    tickAmount: 4
                }
            };
        if (typeof PemakaianChartEl !== undefined && PemakaianChartEl !== null) {
            const PemakaianChart = new ApexCharts(PemakaianChartEl, PemakaianChartConfig);
            PemakaianChart.render();
        }

    })();

</script>
@endsection
