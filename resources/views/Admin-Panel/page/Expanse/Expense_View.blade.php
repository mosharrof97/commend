@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Expense Information</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                            <th scope="row" style="width: 20%">Project Name</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">Coder de Dhaka</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Project Status </th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">On Going</td>
                        </tr>

                        <tr>
                            <th scope="row" style="width: 20%">Project Manager</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">Rakib Hasan</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">date</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">02/03/2024</td>
                        </tr>

                    </table>
                </div>
                <div class="">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Material Name</th>
                                <th scope="col" class="flex-wrap">Quantity & Unit</th>
                                <th scope="col" class="flex-wrap">Price</th>
                                <th scope="col" class="flex-wrap">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Phone</td>
                                <td>10 PC</td>
                                <td>20000</td>
                                <td>200000 Tk</td>

                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td colspan="3">Total</td>
                                <td>200000 Tk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
