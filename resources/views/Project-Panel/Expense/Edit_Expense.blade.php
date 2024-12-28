@extends('Project-Panel.Partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11 col-sm-12">

            <div class="card p-4">
                <div class="card-header ">
                    <div class="col-sm-12 text-center">
                        <h4 class=" font-weight-bold font-italic mt-3">New Expense Form</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="" action="{{ route('project.expense.update',$expense->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row g-3 ">
                            <div class="form-group col-md-6 row mb-3">
                                <label for="date" class="col-sm-3 col-form-label text-right">date</label>
                                <input type="date" class="form-control col-sm-9" id="date" name="date"
                                    value="{{ $expense->date }}">

                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="panel panel-bd text-center">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Material Name</th>
                                                    <th class="text-center">Price </th>
                                                    <th class="text-center">Quantity </th>
                                                    <th class="text-center">Total Price </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dynamic-field-container">
                                                @php
                                                    $names = json_decode($expense->name);
                                                    $quantitys = json_decode($expense->quantity);
                                                    $prices = json_decode($expense->price);
                                                    $total_prices = json_decode($expense->total_price);
                                                @endphp
                                                @foreach($names as $key => $name)
                                                <tr class="parentDiv">
                                                    <td>
                                                        <input type="text" name="name[]" class="form-control"
                                                            id="name" placeholder="Enter Material Name"
                                                            value="{{ $name }}" />
                                                    </td>
                                                    <td>
                                                        <input type="decimal" name="price[]" class="form-control price"
                                                            id="price" value="{{ $prices[$key] }}" />
                                                    </td>
                                                    <td>
                                                        <input type="text" name="quantity[]"
                                                            class="form-control quantity" id="quantity" value="{{ $quantitys[$key] }}" />
                                                    </td>
                                                    <td>
                                                        <input type="decimal" name="total_price[]"
                                                            class="form-control totalPrice" id="totalPrice"
                                                            style="background-color: rgb(218, 218, 218)" value="{{ $total_prices[$key] }}"
                                                            required="" readonly="" />
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right"> Total Amount </td>
                                                    <td>
                                                        <input type="decimal" class="form-control " id="total"
                                                            name="total" style="background-color: rgb(218, 218, 218)"
                                                            value="{{ $expense->total }}" required="" readonly="">
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-check text-start">
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
            // var maxFields = 10;
            // var addButton = $('#add-field');
            var container = $('#dynamic-field-container');
            // var fieldHTML = ` <tr class="remove-tr parentDiv">
            //                 <td><input type="text" name="name[]" class="form-control" id="name" placeholder="Enter Material Name" />

            //                     @error('name')
            //                     <span class="text-danger">{{ $message }}</span>
            //                     @enderror
            //                 </td>
            //                 <td>
            //                     <input type="decimal" name="price[]" class="form-control price" id="price" value="0" />
            //                 </td>
            //                 <td>
            //                     <input type="text" name="quantity[]" class="form-control quantity" id="quantity" />
            //                 </td>
            //                 <td>
            //                     <input type="decimal" name="total_price[]" class="form-control totalPrice"  id="totalPrice" style="background-color: rgb(218, 218, 218)" value="0" required="" readonly=""/>
            //                 </td>
            //                 <td>
            //                     <button type="button"  class="remove-field btn btn-danger">Remove</button>
            //                 </td>
            //             </tr>`;
            // var x = 1;

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


                // var serviceCharge = parseFloat($('#re_service_charge').val()) || 0;
                // var shippingCharge = parseFloat($('#re_shipping_charge').val()) || 0;
                // var discount = parseFloat($('#re_discount').val()) || 0;
                // var paid = parseFloat($('#re_paid').val()) || 0;

                // var total = total;
                // var total_amount = total + serviceCharge + shippingCharge;
                // var due = total_amount - discount - paid;


                // $('#total').val(total.toFixed(2));
                // $('#total_amount').val(total_amount.toFixed(2));
                // $('#re_due').val(due.toFixed(2));
                return total;
            }

            $(document).on('input', '#re_service_charge, #re_shipping_charge, #re_discount, #re_paid', function() {
                sumTotalPrices()
            });

            // $(addButton).click(function() {
            //     if (x < maxFields) {
            //         x++;
            //         $(container).append(fieldHTML);
            //     }
            // });

            // $(container).on('click', '.remove-field', function() {
            //     $(this).closest('.remove-tr').remove();
            //     x--;
            // });
        });
    </script>
@endsection
