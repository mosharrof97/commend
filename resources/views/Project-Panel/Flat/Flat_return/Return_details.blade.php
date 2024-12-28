@extends('Project-Panel.Partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12">
            <div class="card mb-2">
                <div class="card-header justify-content-end py-3">
                    <div class="">
                        {{-- <a class="btn btn-success" href="{{ route('payment.from', $flat->id) }}">Payment</a>
                    <a class="btn btn-success" href="{{ route('return', $flat->id.'part=021364') }}">Flat Return</a> --}}
                        <a class="btn btn-danger" href="{{ url()->previous() }}">back</a>
                    </div>
                </div>
            </div>
            <div class="card p-4" id="saleDetails">
                <div class="card-header justify-content-center">
                    <div class="text-center">
                        <img src="{{ asset('upload/CompanyInfo/' . $comInfo->logo) }}" alt="" width="100">
                        <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                        <h4 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h4>
                        <h3 class="fw-bold"><b>Project:</b>{{ $project->projectName }}</h3>
                        <h4><b>Address:</b> {{ $project->address . ', ' . $project->city }}</h4>
                        <h4>{{ $project->district->name . '- ' . $project->zipCode }}</h4>
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

                    <div class="col-sm-12 p-2 " style="background-color: #c0f0fc">
                        <h4 class="fst-italic fw-bold p-0">Return Flat Information</h3>
                    </div>

                    <div class="col-lg-3  col-md-4 col-sm-12">
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
                                    <td colspan="3" style="width: 77%">{{ $returnInfo->client->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%">Phone</th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ $returnInfo->client->phone }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%">Email</th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ $returnInfo->client->email }}</td>
                                </tr>
                                @php
                                    $address = $returnInfo->client->clientAddress;
                                @endphp
                                <tr>
                                    <th scope="row" style="width: 20%">Address</th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">
                                        {{ $address->pre_address . ', ' . $address->pre_city . ', ' . $address->pre_district . '- ' . $address->pre_zipCode }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="">Flat Name / Number </th>
                                    <td><b>:</b></td>
                                    <td>{{ $returnInfo->flat->name }}</td>
                                </tr>

                                <tr>
                                    <th colspan="">Floor </th>
                                    <td><b>:</b></td>
                                    <td>{{ $returnInfo->flat->floor }}</td>
                                </tr>

                                <tr>
                                    <th colspan="">Sale Price </th>
                                    <td><b>:</b></td>
                                    <td>{{ number_format($returnInfo->buying_price, 2, '.', ',') }}/-</td>
                                </tr>

                                <tr>
                                    <th colspan="">Total Payable Amount </th>
                                    <td><b>:</b></td>
                                    <td>{{ number_format($returnInfo->payable_amount, 2, '.', ',') }}/-</td>
                                </tr>

                                <tr>
                                    <th colspan="">Total Return Amount </th>
                                    <td><b>:</b></td>
                                    <td>{{  number_format($returnPayment->SUM('amount'), 2, '.', ',') }}/-</td>
                                </tr>

                                <tr>
                                    <th colspan="">Payable Amount Due </th>
                                    <td><b>:</b></td>
                                    <td>{{  number_format( $returnInfo->payable_amount - $returnPayment->SUM('amount'), 2, '.', ',') }}/-</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-9  col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="my-4 bg-success p-2" style="background-color: #abecfc">
                        <h4 class="fw-bold fst-italic text-center">Payment</h4>
                    </div>
                    <div class="">
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
                                    <th scope="col" class="flex-wrap action-hide">Action</th>
                                    {{-- <th scope="col" class="flex-wrap">Received_by</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($returnPayment as $key => $payment)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $payment->created_at->format('d-M-y') }}</td>
                                <td>{{ $payment->payment_type }}</td>
                                <td>{{ $payment->bank_name }}</td>
                                <td>{{ $payment->branch }}</td>
                                <td>{{ $payment->account_number }}</td>
                                <td>{{ $payment->check_number}}</td>
                                <td>{{ number_format( $payment->amount,2,'.',',')}}</td>
                                <td class="action-hide">
                                    <a href="{{ route('paySlip',$payment->id) }}"  class="btn btn-light"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="7" class="text-right"> Total </td>
                                <td colspan="">{{number_format(  $returnPayment->sum('amount'),2,'.',',') }}</td>
                            </tr>
                            
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="">
                <button class="btn btn-info" id="paySlipHide" onclick="printDiv('saleDetails')">Print</button>
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
