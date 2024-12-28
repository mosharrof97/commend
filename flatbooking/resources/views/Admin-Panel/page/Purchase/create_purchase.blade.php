@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">

        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">New Purchase</h4>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data" class="form-inline">
                    @csrf
                    <div class="form-group col-md-5 mb-3">
                        <label for="vandor_id" class="col-sm-4 col-form-label text-right">Select Vandor</label>
                        <select name="vandor_id" class="form-control col-sm-8 vandor_id" id="vandor_id" required="">
                            <option value="47">Nerob Traders - 01712-407165</option>
                        </select>

                        @error('vandor_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-5 mb-3">
                        <label for="project_id" class="col-sm-4 col-form-label text-right">Select Project</label>
                        <select name="project_id" class="form-control col-sm-8 project_id" id="project_id" required="">
                            <option value="10">KAZI &amp; WASIT VILLA </option>
                        </select>

                        @error('project_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-5 mb-3">
                        <label for="memo_no" class="col-sm-4 col-form-label text-right">Memo No</label>
                        <input type="test" name="memo_no" class="form-control col-sm-8" value="" required="">

                        @error('memo_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-5 mb-3">
                        <label for="date" class="col-sm-4 col-form-label text-right">Date</label>
                        <input type="date" name="date" id="date" class="form-control col-sm-8" value="2024-04-22">

                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12">

                        <div class="panel panel-bd ">

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Product Name &amp; Model</th>
                                                <th class="text-center">Price </th>
                                                <th class="text-center">Qty </th>
                                                <th class="text-center">Sub Total </th>
                                                <th class="text-center"><a href="#" id="re_addRow" name="addRow" class="btn btn-circle btn-success re_addRow"><i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a></th>
                                            </tr>
                                        </thead>
                                        <tbody id="re_tablefield">

                                            <tr>
                                                <td> <input type="text" name="product[]" class="form-control col-sm-7 product" id="product" placeholder="Enter Product Name" value="" required="">
                                                </td>
                                                <td><input type="number" name="single_price[]" class="form-control col-sm-7 single_price" id="single_price" placeholder="Enter Rate" value="" required=""> </td>
                                                <td><input type="number" name="quantity[]" class="form-control col-sm-7 quantity" id="quantity" placeholder="Enter quantity" value="" required=""></td>
                                                <td><input type="number" name="sub_total[]" class="form-control col-sm-7 sub_total" id="sub_total" value="" readonly=""> </td>
                                                <td class="text-center"><a href="#" id="re_remove" name="add" class="btn btn-danger btn-circle re_remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <td colspan="3" class="text-right"> Sub Total </td>
                                                <td><input type="number" name="total" class="form-control col-sm-7 total" id="total" value="" required="" readonly="">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"> Service Charge </td>
                                                <td><input type="text" name="service_charge" class="form-control col-sm-7 re_service_charge" id="re_service_charge" value="0" required="">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"> Shipping Charge </td>
                                                <td><input type="text" name="shipping_charge" class="form-control col-sm-7 re_shipping_charge" id="re_shipping_charge" value="0" required="">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"> Discount </td>
                                                <td><input type="number" name="discount" class="form-control col-sm-7 re_discount" id="re_discount" value="0" required="">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"> Paid </td>
                                                <td><input type="number" name="paid" class="form-control col-sm-7 re_paid" id="re_paid" value="0" required="">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"> Due </td>
                                                <td><input type="text" name="due" class="form-control col-sm-7 re_due" id="re_due" value="0" required="" readonly="">
                                                </td>
                                                <td></td>
                                            </tr>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-12 mb-3">
                        <button type="submit" class="btn btn-success">Save Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#re_addRow').on('click', function() {
        re_add();
    });

    function re_add() {
        var tr = '<tr>' +
            '<td> <input type="text" name="product[]" class="form-control col-sm-7 product" id="product" placeholder="Enter Product Name" value="" required/></td>' +
            '<td><input type="number" name="single_price[]" class="form-control col-sm-7 single_price" id="single_price" placeholder="Enter Rate" value="" required/> </td>' +
            '<td><input type="number" name="quantity[]" class="form-control col-sm-7 quantity" id="quantity" placeholder="Enter quantity" value="" required/></td>' +
            '<td><input type="number" name="sub_total[]" class="form-control col-sm-7 sub_total" id="sub_total" value="" readonly=""/> </td>' +
            '<td class="text-center"><a href="#" id="re_remove" name="add" class="btn btn-danger btn-circle re_remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>' +
            '</tr>';
        $('#re_tablefield').append(tr);
        $(".select").select2();

        // Calculate subtotal when quantity or single price changes
        $(document).on('input', '.quantity, .single_price', function() {
            var row = $(this).closest('tr');
            var quantity = row.find('.quantity').val();
            var singlePrice = row.find('.single_price').val();
            var subtotal = parseFloat(quantity) * parseFloat(singlePrice);

            // Update the subtotal field
            row.find('.sub_total').val(subtotal.toFixed(2));

            // Recalculate totals
            calculateTotals();
        });

        // Calculate totals
        function calculateTotals() {
            var subtotals = 0;
            $('.sub_total').each(function() {
                subtotals += parseFloat($(this).val());
            });

            var serviceCharge = parseFloat($('#re_service_charge').val()) || 0;
            var shippingCharge = parseFloat($('#re_shipping_charge').val()) || 0;
            var discount = parseFloat($('#re_discount').val()) || 0;
            var paid = parseFloat($('#re_paid').val()) || 0;

            var total = subtotals;
            var due = total + serviceCharge + shippingCharge - discount - paid;

            $('#total').val(total.toFixed(2));
            $('#re_due').val(due.toFixed(2));
        }

        // Recalculate totals when service charge, shipping charge, discount, or paid value changes
        $(document).on('input', '#re_service_charge, #re_shipping_charge, #re_discount, #re_paid', function() {
            calculateTotals();
        });
    };


    $(document).on('click', '#re_remove', function() {
        $(this).parent().parent().remove();
    });

</script>
@endsection
