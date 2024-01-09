@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <h4>Data Karyawan</h4>
    <div class="row">
        @foreach ($datakaryawan as $d)
            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary">
                                    {{ $d->nip }}<br>Ref : {{ $d->referensi_detail ?? '-' }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $d->nama }}</div>
                                <div class="col">
                                    <div class="text-xs text-primary">
                                        {{ $d->kriteriaumum }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                @php
                                    $path = Storage::url('uploads/karyawan/img/' . $d->foto);
                                @endphp
                                <img src="{{ $path }}" style="height:60px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-12">
            {{ $datakaryawan->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <div class="row">
        <!-- Line Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Suku</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-areasuku">
                        <canvas id="myAreaChartsuku" height="320px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pendidikan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChartpendidikan" height="120"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @foreach ($pendidikan as $d)
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> {{ $d->pendidikan }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myAreaChartsuku').getContext('2d');
            var myAreaChartsuku = new Chart(ctx, {
                type: 'line', // Ganti dengan 'area' jika ingin menggunakan area chart
                data: {
                    labels: {!! json_encode($suku->pluck('suku')) !!},
                    datasets: [{
                        label: 'Jumlah Pengguna',
                        data: {!! json_encode($suku->pluck('count')) !!},
                        borderColor: 'rgba(78, 115, 223, 1)',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        pointRadius: 3,
                        pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointBorderColor: 'rgba(78, 115, 223, 1)',
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return value;
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                    }
                },
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myPieChartpendidikan').getContext('2d');
            var myPieChartpendidikan = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($pendidikan->pluck('pendidikan')) !!},
                    datasets: [{
                        data: {!! json_encode($pendidikan->pluck('count')) !!},
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                            '#858796', '#e83e8c'
                        ],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f4b53b',
                            '#e54a34', '#6e7d8b', '#d2366c'
                        ],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        });
    </script>
@endpush
