@extends('Client-Panel.partial.Layout')
@section('content')
    <div class="row mx-0 mb-4">
        <div class="col-12 p-md-0">
            <div class=" bg-info p-2">
                <h4 class="m-0">Name: {{ $client->name }} </h4>
            </div>

        </div>
    </div>

    {{-- Total Report Summary  --}}
    <div class="row page-titles mx-0">
        <div class="col-12 p-md-0">
            <div class=" text-center">
                <h4>Total Report Summary </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card border-primary dash-card">
                <div class="card-body p-3 d-flex justify-content-between d-flex justify-content-between">
                    <div class="text-center">
                        <h5 class="card-result">{{ $flat->count() }}</h5>
                        <h5 class="card-text">Total Flat </h5>
                    </div>
                    <div class="">
                        <div class="icon-circle bg-primary text-white">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:rgb(163, 80, 3)">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        {{-- <h5 class="card-result">{{number_format( $flat->flatSaleInfo->sum('price'),2,'.',',') }}</h5> --}}
                        <h5 class="card-text">Total Flat Price</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: rgb(163, 80, 3)">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#9ac500">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        
                        {{-- <h5 class="card-result">{{number_format( $client->flat->payment->sum('amount'),2,'.',',') }}</h5> --}}
                        <h5 class="card-text">Total Paid Amount</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #9ac500">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#01b4b4">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">{{ $client->flatReInfo->SUM('client_id') }}</h5>
                        <h5 class="card-text">Flat Return</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #01b4b4">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card border-warning dash-card">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">1000</h5>
                        <h5 class="card-text">Total Investor</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle bg-warning  text-white">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card dash-card" style="border-color:#4b5819" >
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">100</h5>
                        <h5 class="card-text">Total Sold</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle text-white" style="background-color: #4b5819">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#940368">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">100</h5>
                        <h5 class="card-text">Total Unsold Flat</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #940368">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#b62c65">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">1000</h5>
                        <h5 class="card-text">Total Invest Amount</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #b62c65">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#3c768d">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">100</h5>
                        <h5 class="card-text">Total Purchase Amount</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #3c768d">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#6c2ffa">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">100</h5>
                        <h5 class="card-text">Paid Purchase Amount</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #6c2ffa">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card  dash-card" style="border-color:#53a885">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div class=" text-center">
                        <h5 class="card-result">100</h5>
                        <h5 class="card-text">Due Purchase Amount</h5>
                    </div>
                    <div class="">
                        <div class="icon-circle  text-white" style="background-color: #53a885">
                            <i class="fa-solid fa-download material-icons" width="50"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Total Report Summary  --}}
@endsection
