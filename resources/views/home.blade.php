@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row mt-4">
            <!-- Registered Civilian-->
             <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($civilian)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Registered Civilians</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Registered Establishments -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($establishment)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Registered Establishments</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Registered Vehicles -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($vehicle)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Registered Vehicles</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recovered -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($recovered)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Recovered</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Confirmed Cases -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($confirmed)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Confirmed Cases</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>
                                    
            <!-- Suspected -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($suspected)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Suspected</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Active Cases -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($active)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Active Cases</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Death -->
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div>
                            <div class="text-value text-primary">{{count($death)}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Death</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                            href="#"><span class="small font-weight-bold">View More</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <h4 class="card-title">Reports</h4>
        <hr>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daily Cases</h5>
                <canvas id="daily" class="h-50"></canvas>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Monthly Cases</h5>
                <canvas id="monthly" class="h-50"></canvas>
            </div>
        </div>

    
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var monthly = document.getElementById('monthly').getContext('2d');
var daily = document.getElementById('daily').getContext('2d');
var d = new Date(); 
let getNumberOfDays = (year, month) => { 
    return new Date(month, year, 0).getDate();
}

 new Chart(monthly, {
    type: 'line',
    data: {
        labels: {!! json_encode($months) !!},
        datasets: [{
            label: '# of Active',
            data: {!! json_encode($reports['monthly']['active']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        },
        {
            label: '# of Suspected',
            data: {!! json_encode($reports['monthly']['suspected']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        },
        {
            label: '# of Recovered',
            data: {!! json_encode($reports['monthly']['recovered']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        },
        {
            label: '# of Death',
            data: {!! json_encode($reports['monthly']['death']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: { 
                    precision: 0
                }
            }
        },
        responsive: true,
    }
});

new Chart(daily, {
    type: 'line',
    data: {
        labels: Array.from(Array(getNumberOfDays(d.getYear(), d.getMonth())).keys()) ,
        datasets: [{
            label: '# of Active',
            data: {!! json_encode($reports['daily']['active']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        },
        {
            label: '# of Suspected',
            data: {!! json_encode($reports['daily']['suspected']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        },
        {
            label: '# of Recovered',
            data: {!! json_encode($reports['daily']['recovered']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        },
        {
            label: '# of Death',
            data: {!! json_encode($reports['daily']['death']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: { 
                    precision: 0
                }
            },
            
        },
        responsive: true,
    }
});
</script>
@endsection
