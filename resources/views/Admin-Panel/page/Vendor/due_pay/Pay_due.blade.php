@extends('Admin-Panel.partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11 col-sm-12">

            <div class="card p-4">
                <div class="card-header ">
                    <div class="col-sm-12 text-center">
                        <h4 class=" font-weight-bold font-italic mt-3">Pay Due Purchase </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="" action="{{ route('store.vendor.purchase.due.pay', $vendor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-inline row g-3">
                            <div class="form-group col-md-6  mb-3">
                                <label for="date" class="col-sm-4 col-form-label text-right bg-info">date</label>
                                <input type="date" class="form-control col-sm-8" id="date" name="date"
                                    value="{{ old('date') }}">

                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="due" class="col-sm-4 col-form-label text-right bg-info">Due</label>
                                <input type="decimal" name="due" class="form-control col-sm-8" id="due"
                                    style="background-color: rgb(218, 218, 218)" value="{{ $vendor->due }}" required=""
                                    readonly="">
                                @error('due')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="payment_type" class="col-sm-4 col-form-label text-right bg-info">Payment
                                    Type</label>
                                {{-- <input type="text" class="form-control" id="payment_type" placeholder="Installment amount" name="payment_type"> --}}
                                <select name="payment_type" id="payment_type" class="form-select col-sm-8">
                                    <option value="">select Payment Type...........</option>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank</option>
                                    <option value="check">Check</option>
                                </select>

                                @error('payment_type')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="pay" class="col-sm-4 col-form-label text-right bg-info">Pay</label>
                                <input type="decimal" name="pay" class="form-control col-sm-8" id="pay"
                                    style="background-color: rgb(243, 243, 243)" value="0" required="">
                                @error('pay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-sm-12 col-form-label text-right">
                                    <span id="payError" class="text-danger"></span>
                                </div>

                            </div>
                        </div>

                        {{-- *********** Bank Details ************* --}}
                        <div class="mt-3 " id="bank_details" style="display: none">
                            <h4>Bank Details</h4>
                            <div class="form-inline row g-3">
                                <div class="form-group col-md-6">
                                    <label for="bank_name" class="col-sm-4 col-form-label text-right bg-info">Bank
                                        Name</label>
                                    <input type="text" class="form-control col-sm-8" id="bank_name"
                                        placeholder="Installment amount" name="bank_name">

                                    @error('bank_name')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6" id="div_branch">
                                    <label for="branch" class="col-sm-4 col-form-label text-right bg-info">Branch</label>
                                    <input type="text" class="form-control col-sm-8" id="branch"
                                        placeholder="Installment amount" name="branch">

                                    @error('branch')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="account_number" class="col-sm-4 col-form-label text-right bg-info">Account
                                        Number</label>
                                    <input type="number" class="form-control col-sm-8" id="account_number"
                                        placeholder="Installment amount" name="account_number">

                                    @error('account_number')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6" id="check_number_div" style="display: none">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="check_number"
                                                class="col-sm-4 col-form-label text-right bg-info">Check
                                                Number</label>
                                            <input type="number" class="form-control col-sm-8" id="check_number"
                                                placeholder="Enter check number..." name="check_number">

                                            @error('check_number')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- *********** Bank Details ************* --}}


                        <div class="row g-3">
                            <div class="col-md-12 text-end">
                                <button type="submit " class="btn btn-primary ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('change', '#pay', function() {
                var pre_due = parseFloat($('#due').val()) || 0;
                var pay = parseFloat($('#pay').val()) || 0;

                if (pre_due < pay) {
                    $('#pay').val(0);
                    $(this).prop('disabled', true);
                    // alert('Payment amount exceeds due amount.');
                    $('#payError').html('Payment amount exceeds due amount.--(Field disabled!)');
                } else {
                    var due = pre_due - pay;
                    $('#due').val(due);
                    // $('#paymentError').text('');
                }
            });
        });
    </script>

    <script>
        $(document).on('change', '#payment_type', function() {
            var payment_type = $(this).val();
            if (payment_type == 'bank' || payment_type == 'check') {
                $('#bank_details').css('display', 'block');
            }else{
                $('#bank_details').css('display', 'none');
            }
            if (payment_type == 'check') {
                $('#check_number_div').css('display', 'block');
            } else if (payment_type == 'bank') {
                $('#check_number_div').css('display', 'none');
            }
        })
    </script>
@endsection
