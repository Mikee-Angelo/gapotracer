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
    </div>
</div>
</div>
@endsection
