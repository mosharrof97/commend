@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Investor Information</h3>
            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="col-lg-8 col-sm-9 col-12">
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
                                <td colspan="3" style="width: 77%">{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Phone</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $data->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Phone</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $data->nid }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Phone</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $data->tin }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Email</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $data->email }}</td>
                            </tr>

                        </table>
                    </div>

                    <div class="col-lg-4 col-sm-3 col-12 text-end">
                        <img src="{{ asset('upload/Investor/'.$data->image) }}" alt="" width="50%">

                    </div>
                    <div class="col-lg-12">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h4 class="text-light text-center">Present Address</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table-information table table-borderless">
                                            <tr>
                                                <th scope="row" style="width: 20%">Address </th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->pre_address }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20%">City</th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->pre_city }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20%">District</th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->pre_district }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20%">Phone</th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->pre_zipCode }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h4 class="text-light text-center">Present Address</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table-information table table-borderless">
                                            <tr>
                                                <th scope="row" style="width: 20%">Address </th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->per_address }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20%">City</th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->per_city }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20%">District</th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->per_district }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20%">Phone</th>
                                                <td colspan="" style="width: 3%">:</td>
                                                <td colspan="3" style="width: 77%">{{ $data->per_zipCode }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <hr>
                    <div class="">
                        <h3>Project Name: Coder de Dhaka (<span class="text-info">On Going</span>)</h3>
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

                    <hr>
                    <div class="">
                        <h3>Project Name: Coder de Dhaka (<span class="text-info">On Going</span>)</h3>
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

                    <hr>
                    <div class="">
                        <h3>Project Name: Coder de Dhaka (<span class="text-success">Complete</span>)</h3>
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
                </>
            </div>
        </div>
    </div>

    @endsection
