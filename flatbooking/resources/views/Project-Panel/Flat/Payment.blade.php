@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">

        <div class="card p-4">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                       {{--<!--<div class="text-center">-->
                        <!--    <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}" alt="" width="100">-->
                        <!--    <h2 class="fw-bold">{{ $comInfo->name }}</h2>-->
                        <!--    <h4 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h4>-->
                        <!--    <h4 class="fw-bold"><b>Project :</b> {{ $flatSaleInfo->flat->project->projectName }}</h3>-->
                        <!--    <h4><b>Address:</b> {{ $flatSaleInfo->flat->project->address.', '.$flatSaleInfo->flat->project->city }}</h4>-->
                        <!--    <h4>{{ $flatSaleInfo->flat->project->district->name.'- '.$flatSaleInfo->flat->project->zipCode}}</h4>-->
                        <!--</div>-->--}}
                        @include('common.CompanyInfo')
    
                        <div class="my-4">
                            <h3 class="fw-bold fst-italic text-center">Payment</h3>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                            <style>
                                th,
                                td {
                                    padding: 0.4rem !important;
                                }
    
                            </style>
                            <tbody>
                                    <tr>
                                        <th class="text-nowrap" scope="row" style="width: 20%">Client Name </th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $flatSaleInfo->flat->client->name }}</td>
                                    </tr>
    
                                    {{-- @php
                                        dd($flatSaleInfo->flat->client->clientAddress);
                                    @endphp --}}
    
                                    <tr>
                                        <th class="text-nowrap" scope="row" style="width: 20%">Address </th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">
                                            {{ $flatSaleInfo->flat->client->clientAddress->pre_address.', '.$flatSaleInfo->flat->client->clientAddress->pre_city}}
                                            {{ $flatSaleInfo->flat->client->clientAddress->per_district.'- '.$flatSaleInfo->flat->client->clientAddress->pre_zipCode}}
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <th class="text-nowrap" scope="row" style="width: 20%">Phone </th>
                                        <td colspan="" style="width: 3%">:</td>
                                        <td colspan="3" style="width: 77%">{{ $flatSaleInfo->flat->client->phone }}</td>
                                    </tr>
    
                                    <tr>
                                        <th class="text-nowrap" colspan="">Flat Name / Number </th>
                                        <td><b>:</b></td>
                                        <td>{{ $flatSaleInfo->flat->name }}</td>
                                    </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    
                    <div class="col-md-6 text-end">
                        <img src="{{ asset('upload/client/'.$flatSaleInfo->flat->client->image) }}" alt="" class="border border-3 p-1" style="height:150px; width:150px">
                    </div>
                </div>

                <form class="" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="flatSaleInfo_id" id="flatSaleInfo_id" value="{{ $flatSaleInfo->id }}">

                        <div class="col-md-6">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date"  name="date">

                            @error('date')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="payable_amount" class="form-label">payable amount</label>
                            <input type="decimal" class="form-control" id="payable_amount" value="{{number_format(($flatSaleInfo->price + $refunds->sum('amount')) - $payment->sum('amount'),2,'.',',') }}" name="payable_amount" readonly>

                            @error('payable_amount')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            {{-- <input type="text" class="form-control" id="payment_type" placeholder="Installment amount" name="payment_type"> --}}
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
                        {{--*********** Bank Details *************--}}

                        <hr>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit " class="btn btn-primary ">Submit</button>
                        </div>

                    </div>
                </form>
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
    })
</script>


@endsection
