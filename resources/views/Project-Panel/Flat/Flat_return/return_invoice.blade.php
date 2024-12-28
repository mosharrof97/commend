@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h4>invoice</h4>
                <div class="">
                    <button class="btn btn-success" id="printButton">print</button>
                    <a class="btn btn-danger" href="{{ route('flat.view.chart') }}">back</a>
                </div>
            </div>
            <style>
                @media print {
                    body.printing * {
                        display: none;
                    }

                    body.printing #print-me {
                        display: block;
                    }
                }

                @media screen {
                    #print-me {
                        display: none;
                    }
                }

            </style>
            <div class="card-body" id="invoice-body" style="background-color: rgb(255, 255, 255)">
                <div>
                    @if (Session::has('message'))
                    <h4 class="text-success ">{{ Session::get('message') }}</h4>
                    @endif

                    @if (Session::has('error'))
                    <h4 class="text-danger">{{ Session::get('error') }}</h4>
                    @endif
                </div>
                <div class="col-md-12" style="background-color: rgb(255, 255, 255)">
                    <div class="text-center">
                        <h2 class="fw-bold">{{ $payment->flat->project->projectName }}</h2>
                        <h4><b>Address:</b> {{ $payment->flat->project->address.', '.$payment->flat->project->city }}</h4>
                        <h4>{{ $payment->flat->project->district->name.'- '.$payment->flat->project->zipCode}}</h4>
                    </div>
                </div>

                <div class="col-sm-12 p-2 " style="background-color: #abecfc">
                    <h2 class="fst-italic fw-bold p-0">Flat Information</h2>
                </div>

                <div class="col-md-12 " style="background-color: rgb(255, 255, 255)">
                    <table class="table table-borderless"  style="">
                        <tbody>

                            <style>
                                th,
                                td {
                                    padding: 0.4rem !important;
                                }

                            </style>

                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">Project Name </th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->project->projectName }}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" colspan="">Flat Name / Number </th>
                                <td><b>:</b></td>
                                <td>{{ $payment->flat->name }}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" colspan="">Floor </th>
                                <td><b>:</b></td>
                                <td>{{ $payment->flat->floor }}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" colspan="">Flat Area </th>
                                <td><b>:</b></td>
                                <td>{{ $payment->flat->flat_area }}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">Flat Price</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ number_format($flatSale->price,2,'.',',')}}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">Paid</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ number_format($payment->sum('amount'),2,'.',',')}}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">Due</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{number_format($flatSale->price - $payment->sum('amount'),2,'.',',')}}</td>
                            </tr>



                        </tbody>
                    </table>
                </div>


                <div class="p-2" style="background-color: #abecfc">
                    <h3 class=" fw-bold fst-italic p-0">Client Information</h3>
                </div>

                <div class="mb-5" style="background-color: rgb(255, 255, 255)">
                    <style>
                        .table-information {
                            width: 100%;
                            margin-bottom: 1rem;
                            color: #BDBDC7;
                        }

                        .table-information th,
                        .table-information td {
                            padding: 0.2rem !important;
                        }

                    </style>
                    <table class="table-information table table-borderless">

                        <tr>
                            <th class="text-nowrap" scope="row" style="width: 20%">Name </th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $payment->flat->client->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row" style="width: 20%">Phone</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $payment->flat->client->phone }}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row" style="width: 20%">Email</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $payment->flat->client->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row" style="width: 20%">NID</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $payment->flat->client->nid }}</td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row" style="width: 20%">TIN</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $payment->flat->client->tin }}</td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row" style="width: 20%">Active status</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $payment->flat->client->active_status }}</td>
                        </tr>

                    </table>
                </div>

                <div class="my-2 p-2" style="background-color:  #abecfc">
                    <h3 class="fw-bold fst-italic p-0">Address Details</h3>
                </div>

                <div class="row" style="background-color: rgb(255, 255, 255)">

                    {{-- <table class="table table-borderless"> --}}

                    <div class="col-md-6 col-12">
                        <h4>Present Address</h4>
                        <table class="table">
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">Address</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->client->clientAddress->pre_address }}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">ZIP Code</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%"> {{ $payment->flat->client->clientAddress->pre_zipCode}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">City</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->client->clientAddress->pre_city }}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">District</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->client->clientAddress->pre_district }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6 col-12">
                        <h4>Present Address</h4>
                        <table class="table">
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">Address</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->client->clientAddress->per_address }}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">ZIP Code</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%"> {{ $payment->flat->client->clientAddress->per_zipCode}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">City</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->client->clientAddress->per_city }}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row" style="width: 20%">District</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $payment->flat->client->clientAddress->per_district }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-2 p-2" style="background-color:  #abecfc">
                    <h3 class="fw-bold fst-italic p-0">Payment</h3>
                </div>
                <div class="" style="background-color: rgb(255, 255, 255)">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="flex-wrap text-nowrap">SL</th>
                                <th scope="col" class="flex-wrap text-nowrap">Payment Type</th>
                                <th scope="col" class="flex-wrap text-nowrap">Bank Name</th>
                                <th scope="col" class="flex-wrap text-nowrap">Branch</th>
                                <th scope="col" class="flex-wrap text-nowrap">Account Number</th>
                                <th scope="col" class="flex-wrap text-nowrap">Check Number</th>
                                <th scope="col" class="flex-wrap text-nowrap">Amount</th>
                                {{-- <th scope="col" class="flex-wrap">Received_by</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td scope="row">1</td>
                                <td>{{ $payment->payment_type }}</td>
                                <td>{{ $payment->bank_name }}</td>
                                <td>{{ $payment->branch }}</td>
                                <td>{{ $payment->account_number }}</td>
                                <td>{{ $payment->check_number}}</td>
                                <td>{{number_format( $payment->amount,2,'.',',')}}</td>
                                {{-- <td>{{ $payment->user->name}}</td> --}}
                                {{-- <td>{{ $payment->check_number}}</td>
                                <td>{{ $total_prices[$key] }}.00</td> --}}
                            </tr>

                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="6" class="text-right"> <b>Service Charge</b> </td>
                                <td>0.00</td>
                            </tr>

                            <tr>
                                <td colspan="6" class="text-right"> <b>Discount</b> </td>
                                <td>0.00</td>
                            </tr>

                            <tr>
                                <td colspan="6" class="text-right"> <b>Total</b> </td>
                                <td colspan="">{{number_format( $payment->amount,2,'.',',')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // $('#printButton').click(function(){
        //     // $("#invoice-body").printThis();
        // });

        $("#printButton").click(function() {
            var originalContent = $("#body").html();
            $("#body").html($('#invoice-body').html());
            window.print();
            $("#body").html(originalContent);
        });
    });

</script>
@endsection
