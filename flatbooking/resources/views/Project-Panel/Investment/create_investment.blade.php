@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">

        <div class="card p-4">
            <div class="card-header">
                <h3>Investment Information</h3>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('store.project.investment') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="client" class="form-label">Client</label>
                            <select name="client_id" id="client" class="form-select bg-light">
                                <option value="">Select client.......</option>
                                @foreach ( $clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <div class="mr-1 ">
                                @error('client_id')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Project details & Investment--}}
                        <hr>
                        <div class="col-md-12">
                            <h4>Investment details</h4>
                        </div>

                        <div class="col-md-6">
                            <label for="total_Investment" class="form-label">Investment Total Amount</label>
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
                            <label for="profit_type" class="form-label">Profit Type</label>
                            <select id="profit_type" class="form-select" name="profit_type">
                                <option value="">Select Profit Type.....</option>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">fixed</option>
                                <option value="flat">flat</option>
                            </select>
                            @error('profit_type')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="profit" class="form-label">Profit</label>
                            <input type="decimal" class="form-control" id="profit" name="profit" placeholder="0.00">
                            @error('profit')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- Project Investment Installment--}}
                        <hr>
                        <div class="col-md-12">
                            <h4> Project Investment </h4>
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
                            <label for="installment_amount" class="form-label">Installment Amount</label>
                            <input type="text" class="form-control" id="installment_amount" placeholder="Installment amount" name="installment_amount">

                            @error('installment_amount')
                                <span class="form-text text-danger" id="installment_amount_error">{{ $message }}</span>
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

                                <div class="col-md-6">
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
                            </div>
                        </div>
                        {{--*********** Bank Details *************--}}


                        {{--*********** Check Details *************--}}
                        <div class="mt-3" id="check_details" style="display: none">
                            <h4>Check Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" placeholder="Installment amount" name="bank_name">

                                    @error('bank_name')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="check_number" class="form-label">Check Number</label>
                                    <input type="number" class="form-control" id="check_number" placeholder="Installment amount" name="check_number">

                                    @error('check_number')
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
                            </div>
                        </div>
                        {{--*********** Check Details *************--}}


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
    $(document).on('change', '#payment_type', function(){
        var payment_type = $(this).val();
        if(payment_type == 'bank'){
            $('#bank_details').css('display', 'block');
            $('#check_details').css('display', 'none');
        } else if(payment_type == 'check'){
            $('#check_details').css('display', 'block');
            $('#bank_details').css('display', 'none');

        }

    })

    $(document).ready(function(){
        $('#installment_amount').on('change', function(){
            var amount = $(this).val();
            var total_Investment = $('#total_Investment').val();
            if(total_Investment < amount){
                alert("Installment Amount is greater than or equal to Total Investment");
            }else {
                $('#bank_details').prop('disabled', false);
            }
        });
    });

    $(document).ready(function(){
        $('#installment_amount').on('change', function(){
            var ins_type = $('#installment_type').val();
            var total_Investment = $('#total_Investment').val();
            var amount = $(this).val();

            if(ins_type == 'fullPaid'){
                if(total_Investment > amount){
                    alert("Installment Amount is Less than Total Investment");
                }
            }
        });
    });
</script>


@endsection
