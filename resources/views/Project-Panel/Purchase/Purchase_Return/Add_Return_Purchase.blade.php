@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11 col-sm-12">

        <div class="card p-4">
            <div class="card-header ">
                <div class="col-sm-12 text-center">
                    <h4 class=" font-weight-bold font-italic mt-3">Purchase Return Form</h4>
                </div>
            </div>
            <div class="card-body">
                <form class="form-inline" action="{{ route('store.project.return.purchase') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <div class="form-group col-md-6  mb-3">
                            <label for="date" class="col-sm-4 col-form-label text-right">Date</label>
                            <input type="date" class="form-control col-sm-8" id="date" name="date" value="">

                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="purchase_id" class="col-sm-4 col-form-label text-right">Select Vandor</label>
                            <select name="purchase_id" class="form-control col-sm-8 vandor_id" id="purchase_id" required="">
                                <option value="">Select Return Invoice....</option>
                                @foreach($purchase as $key => $data)
                                    <option value="{{ $data->id }}">{{ $data->invoice_no .' - '. $data->vendor->name }}</option>
                                @endforeach

                            </select>

                            @error('purchase_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="panel panel-bd ">

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Material Name</th>
                                                <th class="text-center">Price </th>
                                                <th class="text-center">Quantity </th>
                                                <th class="text-center">Unit </th>
                                                <th class="text-center">Total Price </th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dynamic-field-container">
                                            {{-- <div class="mt-3 row align-items-end parentDiv"> --}}
                                            {{-- <td> <input type="text" name="product[]" class="form-control col-sm-7 product" id="product" placeholder="Enter Material Name" value="" required=""></td> --}}

                                            <tr class="parentDiv">
                                                <td>
                                                    <input type="text" name="name[]" class="form-control" id="name" placeholder="Enter Material Name" />
                                                </td>
                                                <td>
                                                    <input type="decimal" name="price[]" class="form-control price" id="price" value="0"/>
                                                </td>
                                                <td>
                                                    <input type="text" name="quantity[]" class="form-control quantity" id="quantity" />
                                                </td>
                                                <td>
                                                    <select name="unit[]" class="form-select unit" id="unit">
                                                        <option value="">Unit.....</option>
                                                        <option value="pc">PC</option>
                                                        <option value="kg">KG</option>
                                                        <option value="liter">Liter</option>
                                                        <option value="miter">miter</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    {{-- <input type="text" name="total_price[]" class="form-control  totalPrice" id="totalPrice" style="background-color: rgb(218, 218, 218)" value="" required="" readonly=""> --}}
                                                    <input type="decimal" name="total_price[]" class="form-control totalPrice" id="totalPrice" style="background-color: rgb(218, 218, 218)" value="0" required="" readonly="" />
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" id="add-field">Add Field</button>
                                                </td>
                                            </tr>
                                            {{-- </div> --}}
                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <td colspan="4" class="text-right"> Total </td>
                                                <td>
                                                    <input type="number" name="total" class="form-control col-sm-7 total" id="total" style="background-color: rgb(218, 218, 218)" value="0" required="" readonly="">
                                                </td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td colspan="4" class="text-right"> Paid </td>
                                                <td>
                                                    <input type="number" name="paid" class="form-control col-sm-7 re_paid" id="re_paid" value="0" required="">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-right"> Due </td>
                                                <td>
                                                    <input type="text" name="due" class="form-control col-sm-7 re_due" id="re_due" style="background-color: rgb(218, 218, 218)" value="0" required="" readonly="">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="mt-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="decimal" class="form-control" id="total" name="total" value="">

                            </div> --}}
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check justify-content-start">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>

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
        var maxFields = 10;
        var addButton = $('#add-field');
        var container = $('#dynamic-field-container');
        var fieldHTML = ` <tr class="remove-tr parentDiv">
                            <td><input type="text" name="name[]" class="form-control" id="name" placeholder="Enter Material Name" />

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="decimal" name="price[]" class="form-control price" id="price" value="0" />
                            </td>
                            <td>
                                <input type="text" name="quantity[]" class="form-control quantity" id="quantity" />
                            </td>
                            <td>
                                <select name="unit[]" class="form-select unit" id="unit">
                                    <option value="">Unit.....</option>
                                    <option value="pc">PC</option>
                                    <option value="kg">KG</option>
                                    <option value="liter">Liter</option>
                                    <option value="miter">miter</option>
                                </select>
                            </td>
                            <td>
                                <input type="decimal" name="total_price[]" class="form-control totalPrice"  id="totalPrice" style="background-color: rgb(218, 218, 218)" value="0" required="" readonly=""/>
                            </td>
                            <td>
                                <button type="button"  class="remove-field btn btn-danger">Remove</button>
                            </td>
                        </tr>`;
        var x = 1;

        $(container).on('keyup', '.price, .quantity', function() {
            var parentDiv = $(this).closest('.parentDiv');
            var quantity = parseFloat(parentDiv.find('.quantity').val()) || 0;
            var price = parseFloat(parentDiv.find('.price').val()) || 0;
            parentDiv.find('.totalPrice').val(quantity * price);
            $('#total').val(sumTotalPrices());
        });

        function sumTotalPrices() {
            var total = 0;
            $('.totalPrice').each(function() {
                total = total + parseFloat($(this).val()) || 0;
            });


            var serviceCharge = parseFloat($('#re_service_charge').val()) || 0;
            var shippingCharge = parseFloat($('#re_shipping_charge').val()) || 0;
            var discount = parseFloat($('#re_discount').val()) || 0;
            var paid = parseFloat($('#re_paid').val()) || 0;

            // var total = total;
            // var total_amount = total ;
            var due = total - paid;


            // $('#total').val(total.toFixed(2));
            // $('#total_amount').val(total_amount.toFixed(2));
            $('#re_due').val(due.toFixed(2));
            return total;
        }

        $(document).on('input', '#re_service_charge, #re_shipping_charge, #re_discount, #re_paid', function() {
            sumTotalPrices()
        });

        $(addButton).click(function() {
            if (x < maxFields) {
                x++;
                $(container).append(fieldHTML);
            }
        });

        $(container).on('click', '.remove-field', function() {
            $(this).closest('.remove-tr').remove();
            x--;
        });
    });

</script>




@endsection
