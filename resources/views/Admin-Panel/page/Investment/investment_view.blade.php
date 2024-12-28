@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Installment Information</h3>
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
                            <th scope="row" style="width: 20%">Name </th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">Md. Rakid Hasan</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Phone</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">0214587842</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Email</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">Rakid@mdo.com</td>
                        </tr>
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
                            <th scope="row" style="width: 20%">Investment Total Amount</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">5000000</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Installment</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">3</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Paid Amount</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">3000000</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Due Amount</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">2000000</td>
                        </tr>

                    </table>
                </div>
                <div class="">
                    <div class="">
                        <h3>Project Name: Coder de Dhaka</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Investment Total Amount</th>
                                <th scope="col">Installment</th>
                                <th scope="col">Paid Amount</th>
                                <th scope="col">Due Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Md. Rakid Hasan</td>
                                <td>0214587842</td>
                                <td>Rakid@mdo.com</td>
                                <td>Coder de Dhaka</td>
                                <td>5000000Tk</td>
                                <td>3</td>
                                <td>3000000</td>
                                <td>2000000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
