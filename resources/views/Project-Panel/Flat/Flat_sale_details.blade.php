@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card mb-2">
            <div class="card-header justify-content-end py-3">
                <div class="">
                    <a class="btn btn-primary" href="{{ route('refund.from', $flat->id) }}">Extra Misc</a>
                    {{-- @if (empty($refunds))
                    <a href="{{ route('refund.details',$flatSale->flat_id) }}"  class="btn btn-info">Extra Misc Details</a>
                    @endif --}}
                    <a class="btn btn-success" href="{{ route('payment.from', $flat->id) }}">Payment</a>
                    <a class="btn btn-success" href="{{ route('return', $flat->id.'part=021364') }}">Flat Return</a>
                    <a class="btn btn-danger" href="{{ url()->previous() }}">back</a>
                </div>
            </div>
        </div>
        <div class="card p-4" id="saleDetails">
            <div class="card-header justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}" alt="" width="150">
                    <h3 class="fw-bold">{{ $comInfo->name }}</h3>
                    <h5 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h5>
                    <h4 class="fw-bold"><b>Project:</b>{{ $flat->project->projectName }}</h4>
                    <h5><b>Address:</b> {{ $flat->project->address.', '.$flat->project->city }}</h5>
                    <h5>{{ $flat->project->district->name.'- '.$flat->project->zipCode}}</h5>
                </div>
            </div>
            <div class="card-body">
                    <div>
                        @if (Session::has('message'))
                        <h4 class="text-success ">{{ Session::get('message') }}</h4>
                        @endif
    
                        @if (Session::has('error'))
                        <h4 class="text-danger">{{ Session::get('error') }}</h4>
                        @endif
                    </div>
                <div class="row">
                    <div class="col-sm-12 p-2 mb-3" style="background-color: #c0f0fc">
                        <h4 class="fst-italic fw-bold p-0">Flat Information</h3>
                    </div>

                    <div class="col-lg-6  col-md-6 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                        <tbody>

                            <style>
                                th,
                                td {
                                    padding: 0.2rem !important;
                                }

                            </style>

                            
                            <tr>
                                <th scope="row" style="width: 20%">Name </th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $flat->client->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Phone</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $flat->client->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Email</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $flat->client->email }}</td>
                            </tr>
                            @php
                                $address =$flat->client->clientAddress;
                            @endphp
                            <tr>
                                <th scope="row" style="width: 20%">Address</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $address->pre_address.', '. $address->pre_city.', '.$address->pre_district.'- '.$address->pre_zipCode}}</td>
                            </tr>
                            <tr>
                                <th colspan="">Flat Name / Number </th>
                                <td><b>:</b></td>
                                <td>{{ $flat->name }}</td>
                            </tr>

                            <tr>
                                <th colspan="">Floor </th>
                                <td><b>:</b></td>
                                <td>{{ $flat->floor }}</td>
                            </tr>

                            <tr>
                                <th colspan="">Flat Area </th>
                                <td><b>:</b></td>
                                <td>{{ $flat->flat_area }}</td>
                            </tr>

                            <tr>
                                <th colspan="">Price </th>
                                <td><b>:</b></td>
                                <td>{{ number_format($flatSale->price,2,'.',',') }}</td>
                            </tr>
                            
                            <tr>
                                <th colspan="">Paid </th>
                                <td><b>:</b></td>
                                @php
                                    $dueAmount = $payments->sum('amount') - $refunds->sum("amount");
                                @endphp
                                <td>{{ number_format($dueAmount,2,'.',',')}}</td>
                            </tr>

                            <tr>
                                <th colspan="">Extra Misc </th>
                                <td><b>:</b></td>
                                <td>{{ number_format($refunds->sum("amount"),2,'.',',')  }}</td>
                            </tr>

                            <tr>
                                <th colspan="">Due </th>
                                <td><b>:</b></td>
                                <td>{{ number_format($flatSale->price - $dueAmount,2,'.',',')  }}</td>
                            </tr>

                            
                                
                        </tbody>
                    </table>
                    </div>
                </div>
                    <div class="col-lg-6  col-md-6 col-sm-12 text-end">
                    <img src="{{ asset('upload/client/'.$flat->client->image) }}" alt="" class="border border-3 p-1" style="height:200px; width:200px">
                </div>
                </div>
                
                <div class="my-4 bg-success p-2" style="background-color: #abecfc">
                    <h4 class="fw-bold fst-italic text-center">Payment</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Date</th>
                                <th scope="col" class="flex-wrap">Payment Type</th>
                                <th scope="col" class="flex-wrap">Bank Name</th>
                                <th scope="col" class="flex-wrap">Branch</th>
                                <th scope="col" class="flex-wrap">Account Number</th>
                                <th scope="col" class="flex-wrap">Check Number</th>
                                <th scope="col" class="flex-wrap">Amount</th>
                                <th scope="col" class="flex-wrap action">Action</th>
                                {{-- <th scope="col" class="flex-wrap">Received_by</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $payments as $key => $payment )
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td> {{ $payment->date ? $payment->date->format('d-M-y') : $payment->created_at->format('d-M-y') }} </td>
                                <td>{{ $payment->payment_type }}</td>
                                <td>{{ $payment->bank_name }}</td>
                                <td>{{ $payment->branch }}</td>
                                <td>{{ $payment->account_number }}</td>
                                <td>{{ $payment->check_number}}</td>
                                <td>{{ number_format( $payment->amount,2,'.',',')}}</td>
                                <td class="action">
                                    <a href="{{ route('paySlip',$payment->id) }}"  class="btn btn-light"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    <a href="{{ route('payment.delete',$payment->id) }}"  class="btn btn-light"><i class="fa-solid fa-trash-can"></i></a>
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="7" class="text-right fw-bold"> Total </td>
                                <td colspan="">{{number_format(  $payments->sum('amount'),2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right fw-bold"> Total Extra Misc</td>
                                <td colspan="">{{number_format(  $refunds->sum('amount'),2,'.',',') }}</td>
                                <td class="action">
                                    <a href="{{ route('refund.details',$flatSale->flat_id) }}"  class="btn btn-light"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </td>  
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right fw-bold"> Total Amount</td>
                                <td colspan="">{{number_format(  $payments->sum('amount') - $refunds->sum('amount'),2,'.',',') }}</td>
                            </tr>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="">
            <button class="btn btn-info" id="paySlipHide"  onclick="printDiv('saleDetails')">Print</button>
        </div>
    </div>
</div>

<script>
// $(document).ready(function() {
//     $('#paySlipHide').on('mouseenter', function() {
//         $('.action-hide').css('display', 'none');
//     });

//     $('#paySlipHide').on('click', function() {
//         $('.action-hide').css('display', 'block');
//     });
// });
</script>
@endsection
