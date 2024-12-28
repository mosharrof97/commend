@extends('Project-Panel.Partial.Layout')
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
                <form class="form-inline row g-3" action="{{ route('store.project.purchase.due.pay',$purchase->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf


                        <div class="form-group col-md-6  mb-3">
                            <label for="date" class="col-sm-4 col-form-label text-right bg-info">date</label>
                            <input type="date" class="form-control col-sm-8" id="date" name="date" value="{{ old('date') }}">

                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="invoice_no" class="col-sm-4 col-form-label text-right bg-info">Invoice</label>
                            {{-- <input type="number" name="invoice_no" class="form-control col-sm-8" id="invoice_no" style="background-color: rgb(218, 218, 218)" value="0" required="" readonly=""> --}}
                            <select name="invoice_no" class="form-select col-sm-8 vandor_id" id="invoice_no" style="background-color: rgb(218, 218, 218)" required="">
                                <option value="{{ $purchase->invoice_no }}">{{ $purchase->invoice_no .' - '. $purchase->vendor->name }}</option>
                            </select>

                            @error('invoice_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="due" class="col-sm-4 col-form-label text-right bg-info">Due</label>
                            <input type="decimal" name="due" class="form-control col-sm-8" id="due" style="background-color: rgb(218, 218, 218)" value="{{  $purchase->due }}" required="" readonly="">
                            @error('due')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="pay" class="col-sm-4 col-form-label text-right bg-info">Pay</label>
                            <input type="decimal" name="pay" class="form-control col-sm-8" id="pay" style="background-color: rgb(243, 243, 243)" value="0" required="">
                            @error('pay')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col-sm-12 col-form-label text-right">
                                <span id="payError" class="text-danger"></span>
                            </div>

                        </div>


                        <div class="col-md-12 text-end">
                            <button type="submit " class="btn btn-primary " >Submit</button>
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




@endsection
