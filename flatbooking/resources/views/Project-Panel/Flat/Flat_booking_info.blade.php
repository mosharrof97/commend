@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            {{-- <div class="card-header">
                <h4>Flat Booking Info</h4>
                <a class="btn btn-danger" href="{{ url()->previous() }}">back</a>
        </div> --}}
        <div class="card-body">
            <div>
                @if (Session::has('message'))
                <h4 class="text-success ">{{ Session::get('message') }}</h4>
                @endif

                @if (Session::has('error'))
                <h4 class="text-danger">{{ Session::get('error') }}</h4>
                @endif
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="fw-bold">Flat Booking System</h1>
                    <h3 class="fw-bold"><b>Email :</b> flat@bookingsystem.com</h3>
                    <h4 class="fw-bold"><b>Project :</b> {{ $booking->flat->project->projectName }}</h3>
                        <h4><b>Address:</b> {{ $booking->flat->project->address.', '.$booking->flat->project->city}}</h4>
                        <h4>{{ $booking->flat->project->district->name.'- '.$booking->flat->project->zipCode}}</h4>
                </div>
            </div>

            <div class="col-sm-12 p-2 " style="background-color: #abecfc">
                <h2 class="fst-italic fw-bold p-0">Flat Information</h2>
            </div>

            <div class="col-lg-3  col-md-4 col-sm-6">
                <table class="table table-borderless">
                    <tbody>

                        <style>
                            th,
                            td {
                                padding: 0.4rem !important;
                            }

                        </style>

                        <tr>
                            <th colspan="">Flat Name / Number </th>
                            <td><b>:</b></td>
                            <td>{{ $booking->flat->name }}</td>
                        </tr>

                        <tr>
                            <th colspan="">Floor </th>
                            <td><b>:</b></td>
                            <td>{{ $booking->flat->floor }}</td>
                        </tr>

                        <tr>
                            <th colspan="">Flat Area </th>
                            <td><b>:</b></td>
                            <td>{{ $booking->flat->flat_area }}</td>
                        </tr>

                        <tr>
                            <th colspan="">Price </th>
                            <td><b>:</b></td>
                            <td>{{ $booking->flat->price *  $booking->flat->flat_area}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="card-header" style="background-color: #abecfc">
                <h3 class=" fw-bold fst-italic p-0">Client Information</h3>
            </div>

            {{-- --}}
            <div class="card-body">
                <div class="mb-5">
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
                            <td colspan="3" style="width: 77%">{{ $booking->flat->client->name }}</td>
                            {{-- <td>{{ $booking->flat->client->name }}</td> --}}

                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Phone</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $booking->flat->client->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Email</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $booking->flat->client->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">NID</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $booking->flat->client->nid }}</td>
                        </tr>

                        <tr>
                            <th scope="row" style="width: 20%">TIN</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $booking->flat->client->tin }}</td>
                        </tr>

                        <tr>
                            <th scope="row" style="width: 20%">Flat</th>
                            <td colspan="" style="width: 3%">:</td>

                            @if($booking->flat->client->sale_status == 1)
                            <div class="d-flex align-items-center">
                                <span class="bg-info p-2 me-1 rounded-circle "></span>
                                <span class="text-info">Booking</span>
                            </div>
                            @elseif($booking->flat->client->sale_status == 2)
                            <div class="d-flex align-items-center">
                                <span class="bg-success p-2 me-1 rounded-circle "></span>
                                <span class="text-success">Buy</span>
                            </div>
                            @endif

                        </tr>

                        <tr>
                            <th scope="row" style="width: 20%">Active status</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $booking->flat->client->active_status }}</td>
                        </tr>

                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 p-2" style="background-color: #abecfc">
                        <h3 class="fw-bold fst-italic p-0">Address Details</h3>
                    </div>
                    {{-- <table class="table table-borderless"> --}}

                    <div class="col-md-6 col-12">
                        <h4>Present Address</h4>
                        <table class="table">
                            <tr>
                                <th scope="row" style="width: 20%">Address</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $booking->flat->client->clientAddress->pre_address }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">ZIP Code</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%"> {{ $booking->flat->client->clientAddress->pre_zipCode}}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">City</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $booking->flat->client->clientAddress->pre_city }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">District</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $booking->flat->client->clientAddress->pre_district }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6 col-12">
                        <h4>Present Address</h4>
                        <table class="table">
                            <tr>
                                <th scope="row" style="width: 20%">Address</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $booking->flat->client->clientAddress->per_address }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">ZIP Code</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%"> {{ $booking->flat->client->clientAddress->per_zipCode}}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">City</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $booking->flat->client->clientAddress->per_city }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">District</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $booking->flat->client->clientAddress->per_district }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a class="btn btn-danger" href="{{ url()->previous() }}">back</a>
                <a class="btn btn-success" href="{{ url()->previous() }}">Buy</a>
            </div>
        </div>
    </div>
</div>
</div>

<script>

</script>
@endsection
