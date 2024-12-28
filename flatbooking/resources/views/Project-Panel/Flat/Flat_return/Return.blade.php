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
                        <h3 class="fw-bold">{{ $flat->project->projectName }}</h3>
                        <h5><b>Address:</b> {{ $flat->project->address.', '.$flat->project->city}}</h5>
                        <h5>{{ $flat->project->district->name.'- '.$flat->project->zipCode}}</h5>
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
                                <td>{{ $flat->flat_area }}</td>
                            </tr>

                            <tr>
                                <th colspan="">Price </th>
                                <td><b>:</b></td>
                                <td>{{ $flat->price *  $flat->flat_area}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="col-md-12">
                    {{-- <form class="row g-3" action="{{ route('flat.sale.form',$flat->id) }}" method="get" enctype="multipart/form-data">
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
                    </form> --}}

                    <div class="card p-4  shadow-none">
                        <div class="card-header" style="background-color: #abecfc">
                            <h3 class=" fw-bold fst-italic p-0">Client Information</h3>
                        </div>
                        {{-- @if($clientInfo !== "") --}}
                        {{-- --}}
                        <div class="card-body">
                            <div class=" row mb-5">
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
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table-information table table-borderless">
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
                                        <tr>
                                            <th scope="row" style="width: 20%">NID</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->nid }}</td>
                                        </tr>
    
                                        <tr>
                                            <th scope="row" style="width: 20%">TIN</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->tin }}</td>
                                        </tr>
    
                                        <tr>
                                            <th scope="row" style="width: 20%">Flat Booking</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">3 Flat</td>
                                        </tr>
    
                                        <tr>
                                            <th scope="row" style="width: 20%">Active status</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->active_status }}</td>
                                        </tr>
    
                                    </table>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <img src="{{ asset('upload/client/'.$flat->client->image) }}" alt="" class="border border-3 p-1" style="height:150px; width:150px">
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
                                            <td colspan="3" style="width: 77%">{{ $flat->client->clientAddress->pre_address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">ZIP Code</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%"> {{ $flat->client->clientAddress->pre_zipCode}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">City</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->clientAddress->pre_city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">District</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->clientAddress->pre_district }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6 col-12">
                                    <h4>Present Address</h4>
                                    <table class="table">
                                        <tr>
                                            <th scope="row" style="width: 20%">Address</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->clientAddress->per_address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">ZIP Code</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%"> {{ $flat->client->clientAddress->per_zipCode}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">City</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->clientAddress->per_city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="width: 20%">District</th>
                                            <td colspan="" style="width: 3%">:</td>
                                            <td colspan="3" style="width: 77%">{{ $flat->client->clientAddress->per_district }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="my-4 bg-success p-2" style="background-color: #abecfc">
                                <h3 class="fw-bold fst-italic text-center">Payment Return</h3>
                            </div>
                            <div class="mt-4">
                                {{-- <form action="{{ route('flat_booking',$flat->id) }}" method="post" class="mx-2">
                                @csrf
                                <input type="hidden" name="client_id" id="client_id" value="{{ $clientInfo->id }}">
                                <button type="submit" class="btn btn-primary">Booking Now</button>
                                </form> --}}

                                <form action="{{ route('return.store') }}" method="post" class="mx-2">
                                    @csrf
                                    <input type="hidden" name="flat_id" id="flat_id" value="{{ $flat->id }}">
                                    <input type="hidden" name="sold_by" id="sold_by" value="{{ $flat->flatSaleInfo->sold_by }}">
                                    <input type="hidden" name="client_id" id="client_id" value="{{ $flat->client->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="buying_price" class="form-label">Buying Price</label>
                                            <input type="decimal" class="form-control" id="buying_price" name="buying_price" value="{{ $flat->flatSaleInfo->price }}"  placeholder="0.00"  @readonly(true) style="background-color: #e7e7e7">
                                            @error('buying_price')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="payable_amount" class="form-label">Payable Amount</label>
                                            <input type="decimal" class="form-control" id="payable_amount" name="payable_amount" value="{{ $flat->payment->sum('amount') }}.00"  placeholder="0.00"  @readonly(true) style="background-color: #e7e7e7">
                                            @error('payable_amount')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <label for="return_type" class="form-label">Return Type</label>
                                            <select id="return_type" class="form-select" name="return_type">
                                                <option value="">Select Return Type.....</option>
                                                <option value="fullPaid">Full Paid</option>
                                                <option value="return">Return</option>
                                            </select>
                                            @error('return_type')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        {{-- <div class="col-md-12 my-2 mx-0">
                                            <h4 class="p-3" style="background-color: #e7e7e7"><b>Payable Amount : </b> {{ $flat->flatSaleInfo[0]->price }} TK</h4>
                                        </div> --}}
                                        <div class="col-md-12 mt-3">
                                            <input type="checkbox" name="checkBox" id="checkBox" value="Instant Pay">
                                            <label class="form-check-label" for="checkBox">
                                                Instant Pay.
                                            </label>
                                        </div>

                                        <div class="col-md-12" id="hiddenDiv" style="display: none">
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label for="payment_type" class="form-label">Payment Return Method </label>
                                                    <select name="payment_type" id="payment_type" class="form-select">
                                                        <option value="">select Method...........</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="bank">Bank</option>
                                                        <option value="check">Check</option>
                                                    </select>

                                                    @error('payment_type')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-3">
                                                    <label for="return_amount" class="form-label"> Amount</label>
                                                    <input type="text" class="form-control" id="return_amount" placeholder="Return amount......" name="return_amount">

                                                    @error('return_amount')
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
                                                {{--*********** Bank Details *************--}}
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3 text-end">
                                            <button type="submit" class="btn btn-success">Return</button>
                                        </div>
                                    </div>
                                </form>
                                {{-- <a href="" class="btn btn-success">Buy Now</a> --}}
                            </div>
                        </div>
                        {{-- @else
                        <div class="card-body" style="background-color: #eeeeee">
                            <h4 class="text-center fw-bold fst-italic">No Client Information</h4>
                        </div>
                        @endif --}}
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#checkBox').change(function() {
            if ($(this).is(':checked')) {
                $('#hiddenDiv').css('display','block');
            } else {
                $('#hiddenDiv').css('display','none');
            }
        });
    });
</script>

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
