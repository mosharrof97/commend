@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11 col-sm-12">

        <div class="card p-4">
            <div class="card-header">
                <h3>Expense Form</h3>
            </div>
            <div class="card-body">
                <form class="" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="date" class="form-label">date</label>
                            <input type="date" class="form-control" id="date" name="date" value="" >
                        </div>

                        <div class="col-md-12">
                            <div id="dynamic-field-container">
                                <div class="mt-3 row align-items-end parentDiv">
                                    <div class="col-md-4 col-12">
                                        <label for="name" class="form-label">Material Name</label>
                                        <input type="text" name="name[]" class="form-control" id="name" />
                                    </div>
                                    <div class="col-md-1 col-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" name="quantity[]" class="form-control quantity" id="quantity" />
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <label for="unit" class="form-label">Unit</label>
                                        <select name="unit[]" class="form-select unit" id="unit">
                                            <option value="">Unit.....</option>
                                            <option value="pc">PC</option>
                                            <option value="kg">KG</option>
                                            <option value="liter">Liter</option>
                                            <option value="miter">miter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="decimal" name="price[]" class="form-control price" id="price" />
                                    </div>

                                    <div class="col-md-2 col-6">
                                        <label for="totalPrice" class="form-label">Total Price</label>
                                        <input type="decimal" name="totalPrice[]" class="form-control totalPrice" id="totalPrice" />
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <button type="button" class="btn btn-primary" id="add-field">Add Field</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="decimal" class="form-control" id="total" name="total" value="" >

                        </div>
                        <hr>
                        <div class="col-md-12">
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
    $(document).ready(function() {
        var maxFields = 10;
        var addButton = $('#add-field');
        var container = $('#dynamic-field-container');
        var fieldHTML = `<div class="mt-3 row align-items-end remove-div parentDiv ">
                            <div class="col-md-4 col-12">
                                <label for="name" class="form-label">Material Name</label>
                                <input type="text" name="name[]" class="form-control" id="name" />
                            </div>
                            <div class="col-md-1 col-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="text" name="quantity[]" class="form-control quantity" id="quantity" />
                            </div>
                            <div class="col-md-2 col-4">
                                <label for="unit" class="form-label">Unit</label>
                                <select name="unit[]" class="form-select unit" id="unit">
                                    <option value="">Unit....</option>
                                    <option value="pc">PC</option>
                                    <option value="kg">KG</option>
                                    <option value="liter">Liter</option>
                                    <option value="miter">miter</option>
                                </select>
                            </div>
                            <div class="col-md-1 col-3">
                                <label for="price" class="form-label">price</label>
                                <input type="decimal" name="price[]" class="form-control price" id="price" />
                            </div>

                            <div class="col-md-2 col-6">
                                <label for="totalPrice" class="form-label">Total Price</label>
                                <input type="decimal" name="totalPrice[]" class="form-control totalPrice" id="totalPrice" />
                            </div>
                            <div class="col-md-2 col-6">
                                <button type="button"  class="remove-field btn btn-danger">Remove</button>
                            </div>
                        </div>`;
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
            return total;
        }

        $(addButton).click(function() {
            if (x < maxFields) {
                x++;
                $(container).append(fieldHTML);
            }
        });

        $(container).on('click', '.remove-field', function() {
            $(this).closest('.remove-div').remove();
            x--;
        });
    });

</script>




@endsection
