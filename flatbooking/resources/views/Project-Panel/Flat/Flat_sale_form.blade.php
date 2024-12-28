@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h4>Flat Sale</h4>
                <a class="btn btn-danger" href="{{ url()->previous() }}">back</a>
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
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}" alt="" width="100">
                        <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                        <h4 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h4>
                        <h2 class="fw-bold"><b>Project:</b>{{ $project->projectName }}</h2>
                        <h4><b>Address:</b> {{ $project->address.', '.$project->city }}</h4>
                        <h4>{{ $project->district->name.'- '.$project->zipCode}}</h4>
                    </div>
                </div>

                <div class="col-sm-12 p-2 " style="background-color: #abecfc">
                    <h2 class="fst-italic fw-bold p-0">Flat Information</h2>
                </div>

                <div class="col-lg-3  col-md-4 col-sm-6">
                    <table class="table table-borderless">
                        <tbody>

                            <style>
                                th,
                                td {
                                    padding: 0.4rem !important;
                                }

                            </style>

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
                                <td>{{ $flat->flat_area }} sft</td>
                            </tr>


                            {{--  <tr>
                                <th colspan="">Price </th>
                                <td><b>:</b></td>
                                <td>{{ $flat->price *  $flat->flat_area}}</td>
                            </tr>  --}}
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="col-md-12">
                    <form class="row g-3" action="{{ route('flat.sale.form',$flat->id) }}" method="get" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-md-6 mb-3">
                            <div class="row ">
                                <h4 for="client" class="col-sm-4 col-form-label text-right ">Client Information</h4>
                                <select name="client" id="client" class="form-select col-sm-8">
                                    <option value="">Select Client.........</option>
                                    @foreach($clients as $key => $client)
                                    <option value="{{ $client->id }}">{{ $client->name .' - '. $client->phone }}</option>
                                    @endforeach
                                </select>

                                @error('client')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 text-start">
                            <button type="submit " class="btn btn-primary ">Submit</button>
                        </div>
                    </form>

                    <div class="card p-4  shadow-none">
                        <div class="card-header" style="background-color: #abecfc">
                            <h3 class=" fw-bold fst-italic p-0">Client Information</h3>
                        </div>
                        @if($clientInfo !== "")
                        {{-- --}}
                        <div class="card-body row">
                            <div class="card-body row">
                                <div class="col-md-6 mb-5">
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
                                            <th scope="row" style="width: 20%">Name </th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">Phone</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">Email</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">NID</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->nid }}</td>
                                        </tr>
    
                                        <tr>
                                            <th scope="row" style="width: 20%">TIN</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->tin }}</td>
                                        </tr>
    
                                        <tr>
                                            <th scope="row" style="width: 20%">Flat Booking</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">3 Flat</td>
                                        </tr>
    
                                        <tr>
                                            <th scope="row" style="width: 20%">Active status</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->active_status }}</td>
                                        </tr>
    
                                    </table>
                                </div>
                                <div class="col-md-6 text-end">
                                    <img src="{{ asset('upload/client/'.$clientInfo->image) }}" alt="" class="border border-3 p-1" style="height:200px; width:200px">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4 p-2" style="background-color: #abecfc">
                                    <h3 class="fw-bold fst-italic p-0">Address Details</h3>
                                </div>
                                {{-- <table class="table table-borderless"> --}}

                                <div class="col-md-6 col-12">
                                    <h4>Present Address</h4>
                                    <table class="table">
                                        <tr>
                                            <th scope="row" style="width: 20%">Address</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->clientAddress->pre_address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">ZIP Code</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%"> {{ $clientInfo->clientAddress->pre_zipCode}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">City</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->clientAddress->pre_city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">District</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->clientAddress->pre_district }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6 col-12">
                                    <h4>Present Address</h4>
                                    <table class="table">
                                        <tr>
                                            <th scope="row" style="width: 20%">Address</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->clientAddress->per_address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">ZIP Code</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%"> {{ $clientInfo->clientAddress->per_zipCode}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">City</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->clientAddress->per_city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">District</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $clientInfo->clientAddress->per_district }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="my-4 bg-success p-2" style="background-color: #abecfc">
                                <h3 class="fw-bold fst-italic text-center">Payment</h3>
                            </div>
                            <div class="mt-4">
                                {{-- <form action="{{ route('flat_booking',$flat->id) }}" method="post" class="mx-2">
                                @csrf
                                <input type="hidden" name="client_id" id="client_id" value="{{ $clientInfo->id }}">
                                <button type="submit" class="btn btn-primary">Booking Now</button>
                                </form> --}}

                                <form action="{{ route('flat.sale',$flat->id) }}" method="post" class="mx-2">
                                    @csrf
                                    <input type="hidden" name="client_id" id="client_id" value="{{ $clientInfo->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="total_Investment" class="form-label">Price</label>
                                            <input type="decimal" class="form-control" id="total_Investment" name="total_Investment" placeholder="0.00">
                                            @error('total_Investment')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="installment_type" class="form-label">Installment Type</label>
                                            <select id="installment_type" class="form-select" name="installment_type">
                                                <option value="">Select Installment Type.....</option>
                                                <option value="fullPaid">Full Paid</option>
                                                <option value="installment">Installment</option>
                                            </select>
                                            @error('installment_type')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="payment_type" class="form-label">Payment Type</label>
                                            <select name="payment_type" id="payment_type" class="form-select">
                                                <option value="">select Payment Type...........</option>
                                                <option value="cash">Cash</option>
                                                <option value="bank">Bank</option>
                                                <option value="check">Check</option>
                                            </select>

                                            @error('payment_type')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="amount" class="form-label"> Amount</label>
                                            <input type="text" class="form-control" id="amount" placeholder="Installment amount" name="amount">

                                            @error('amount')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <hr>

                                        {{--*********** Bank Details *************--}}
                                        <div class="mt-3" id="bank_details" style="display: none">
                                            <h4>Bank Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="bank_name" class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" placeholder="Installment amount" name="bank_name">

                                                    @error('bank_name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6" id="div_branch" >
                                                    <label for="branch" class="form-label">Branch</label>
                                                    <input type="text" class="form-control" id="branch" placeholder="Installment amount" name="branch">

                                                    @error('branch')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="number" class="form-control" id="account_number" placeholder="Installment amount" name="account_number">

                                                    @error('account_number')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6" id="div_check_number" style="display: none">
                                                    <label for="check_number" class="form-label">Check Number</label>
                                                    <input type="number" class="form-control" id="check_number" placeholder="Installment amount" name="check_number">

                                                    @error('check_number')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{--*********** Bank Details End*************--}}

                                        <div class="col-md-12 mt-3 text-end">
                                            <button type="submit" class="btn btn-success">Buy Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="card-body" style="background-color: #eeeeee">
                            <h4 class="text-center fw-bold fst-italic">No Client Information</h4>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('change', '#payment_type', function() {
        var payment_type = $(this).val();
        if (payment_type == 'bank' || payment_type == 'check' ) {
            $('#bank_details').css('display', 'block');
        }
        if (payment_type == 'check') {
            $('#div_check_number').css('display', 'block');
        }else if (payment_type == 'bank') {
            $('#div_check_number').css('display', 'none');
        }

        if (payment_type == 'cash') {
            $('#bank_details').css('display', 'none');
        }

    })

    $(document).ready(function() {
        // $('#installment_type').on('change', function() {
        //     var installment_type = $(this).val();
        //     // alert(installment_type);
        //     var total_Investment = $('#total_Investment').val();
        //     if (total_Investment <= amount) {
        //         alert("Installment Amount is greater than or equal to Total Investment");
        //     }
        // });


        $('#installment_amount').on('change', function() {
            var amount = $(this).val();
            var total_Investment = $('#total_Investment').val();
            if (total_Investment <= amount) {
                alert("Installment Amount is greater than or equal to Total Investment");
            }
        });


    });

</script>
@endsection
