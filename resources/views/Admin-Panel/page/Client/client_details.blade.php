@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-3" >
            
            <div class="card-body">
                
                <style>
                    /* .table-information {
                        width: 100%;
                        margin-bottom: 1rem;
                        color: #BDBDC7;
                    }

                    .table-information th,
                    .table-information td {
                        padding: 0.2rem !important;
                        font-size: 15px;
                        font-style: italic;
                        font-family: emoji;
                    } */
                    .client-info th,
                    .client-info td {
                        padding: 0.2rem !important;
                        font-size: 15px;
                        font-style: italic;
                        font-family: emoji;
                    }
                    h3,h4{
                        font-style: italic;
                        font-family: emoji; 
                    }

                </style>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="padding: 5px 10px; background-color:#d1e7dd">
                                <h3 class="m-0">Client Information</h3>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <table class="client-info" style="color: black !important">
                                    <tr>
                                        <th scope="row" style="width: ">Name </th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $client->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: ">Phone</th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $client->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: ">Email</th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $client->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: ">NID</th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $client->nid }}</td>
                                    </tr>
            
                                    <tr>
                                        <th scope="row" style="width: ">TIN</th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $client->tin }}</td>
                                    </tr>
            
                                    <tr>
                                        <th scope="row" style="width: ">Flat Booking</th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $flats->count('client_id') == 0 ? '0 Flat' : $flats->count('client_id') . ' Flat' }}</td>
                                        
                                    </tr>
            
                                    <tr>
                                        <th scope="row" style="width: ">Active status</th>
                                        <td colspan="" style="width: 20px">:</td>
                                        <td colspan="3" style="width: ">{{ $client->active_status }}</td>
                                    </tr>
            
                                </table>
                                </div>
                                <div class="col-md-6 text-end">
                                    <img src="{{ asset('upload/client/'.$client->image) }}" alt="" class="border border-3 p-1" style="height:250px; width:250px">
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-5 col-12">
                        <div class="card">
                            <div class="card-header" style="padding: 5px 10px; background-color:#d1e7dd">
                                <h4 class="m-0">Present Address</h4>
                            </div>
                            <div class="card-body">
                                {{-- <table class="table table-borderless"> --}}                                    
                                <table class="table client-info">
                                    <tr>
                                        <th scope="row" style="width: 20%">Address</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $client->clientAddress->pre_address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">ZIP Code</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%"> {{ $client->clientAddress->pre_zipCode}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">City</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $client->clientAddress->pre_city }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">District</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $client->clientAddress->pre_district }}</td>
                                    </tr>
                                </table>                                
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="padding: 5px 10px; background-color:#d1e7dd">
                                <h4 class="m-0">Present Address</h4>
                            </div>
                            <div class="card-body">                                   
                                <table class="table client-info">
                                    <tr>
                                        <th scope="row" style="width: 20%">Address</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $client->clientAddress->per_address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">ZIP Code</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%"> {{ $client->clientAddress->per_zipCode}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">City</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $client->clientAddress->per_city }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">District</th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $client->clientAddress->per_district }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table client-info table-bordered">
                                        <thead class="table-success p-2">
                                            <tr >
                                                <th scope="col">SL</th>
                                                <th scope="col">Project Name</th>
                                                <th scope="col">Floor</th>
                                                <th scope="col">flat</th>
                                                <th scope="col">flat Area</th>
                                                <th scope="col">flat Price</th>
                                                <th scope="col">Pay Amount</th>
                                                <th scope="col">Extra Misc Amount</th>
                                                <th scope="col">Net Pay Amount</th>
                                                <th scope="col">Due Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($flats as $key => $flat) 
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $flat->project->projectName }}</td>
                                                <td>{{ $flat->floor }}</td>
                                                <td>{{ $flat->name }} </td>
                                                <td>{{ $flat->flat_area }} Squer Fit</td>
                                                <td>{{ number_format($flat->flatSaleInfo->price,2,'.',',') }}</td>
                                                @php
                                                    $refundAmount = $flat->payment->sum('amount') - $flat->refund->sum('amount');
                                                @endphp
                                                <td>{{ number_format($flat->payment->sum('amount'),2,'.',',') }}</td>
                                                <td>{{ number_format($flat->refund->sum('amount'),2,'.',',') }}</td>
                                                <td>{{ number_format($refundAmount,2,'.',',') }}</td>
                                                <td>{{ number_format($flat->flatSaleInfo->price - $refundAmount,2,'.',',') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <table class="table client-info table-bordered">
                                        <thead class="table-success p-2">
                                            <tr>
                                                <th scope="col" class="flex-wrap">SL</th>
                                                <th scope="col" class="flex-wrap">Date</th>
                                                <th scope="col" class="flex-wrap">Project</th>
                                                <th scope="col" class="flex-wrap">Flat</th>
                                                <th scope="col" class="flex-wrap">Payment Type</th>
                                                <th scope="col" class="flex-wrap">Bank Name</th>
                                                <th scope="col" class="flex-wrap">Branch</th>
                                                <th scope="col" class="flex-wrap">Account Number</th>
                                                <th scope="col" class="flex-wrap">Check Number</th>
                                                <th scope="col" class="flex-wrap">Amount</th>
                                                <th scope="col" class="flex-wrap">Received_by</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $payments as $key => $payment )
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $payment->date == null ? $payment->created_at->format('d-M-y') : $payment->date->format('d-M-y') }}</td>
                                                <td>{{ $payment->flat->project->projectName }}</td>
                                                <td>{{ $payment->flat->name }}</td>
                                                <td>{{ $payment->payment_type }}</td>
                                                <td>{{ $payment->bank_name }}</td>
                                                <td>{{ $payment->branch }}</td>
                                                <td>{{ $payment->account_number }}</td>
                                                <td>{{ $payment->check_number}}</td>
                                                <td>{{ number_format( $payment->amount,2,'.',',')}}</td>   
                                                <td>{{ $payment->user->name}}</td>                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                
                                            <tr>
                                                <td colspan="9" class="text-right fw-bold"> Total </td>
                                                <td colspan="">{{number_format(  $payments->sum('amount'),2,'.',',') }}</td>
                                                <td colspan=""></td>
                                            </tr>

                                            <tr>
                                                <td colspan="9" class="text-right fw-bold"> Total Extra Misc </td>
                                                <td colspan="">{{number_format(  $refunds->sum('amount'),2,'.',',') }}</td>
                                                <td colspan=""></td>
                                            </tr>

                                            <tr>
                                                <td colspan="9" class="text-right fw-bold"> Total Amount </td>
                                                <td colspan="">{{number_format(  $payments->sum('amount') - $refunds->sum('amount'),2,'.',',') }}</td>
                                                <td colspan=""></td>
                                            </tr>
                                            
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
