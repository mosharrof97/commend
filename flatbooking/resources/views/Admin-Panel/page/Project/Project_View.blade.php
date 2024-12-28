@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Project Details Information</h3>
                <a href="{{ route('list.project') }}" class="btn btn-danger">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}" alt="" width="100">
                            <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                            <h4 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h4>
                            <h4 class="fw-bold"><b>Project :</b> {{ $project->projectName }}</h3>
                            <h4><b>Address:</b> {{ $project->address.', '.$project->city }}</h4>
                            <h4>{{ $project->district->name.'- '.$project->zipCode}}</h4>
                        </div>
                    </div>
                    <div class="col-md-8 col-12 mt-4">
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
                                <th scope="row" style="width: 20%">Project Name </th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->projectName }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Project Status </th>
                                <td colspan="" style="width: 3%">:</td>
                                @if ($project->status === 0)
                                <td colspan="3" style="width: 77%">On Going</td>
                                @elseif ($project->status === 1)
                                <td colspan="3" class="text-success" style="width: 77%">completed</td>
                                @endif

                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Project Budget</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ number_format( $project->budget==0 ? 0 : $project->budget,2,'.',',')}} TK</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Land Area</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->land_area ==0? 0 : $project->land_area}} Squer Fit</td>
                            </tr>

                            <tr>
                                <th scope="row" style="width: 20%">Investor</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $investment->groupBy('client_id')->count() }} </td>
                            </tr>

                            <tr>
                                <th scope="row" style="width: 20%">Investment Amount</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ number_format( 25000000 ,2,'.',',') }}TK</td>
                            </tr>

                            <tr>
                                <th scope="row" style="width: 20%">Floor</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->floor }} Floor</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Flat </th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->flat == 0 ? 0 : $project->flat }} flat</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Flat Area</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->flat_area == 0 ? 0 : $project->flat_area }} Squer Fit</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Start Date</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%; color:#0096bb">{{ $project->start_date->format('d-M-y') }}</td>
                            </tr>

                            <tr>
                                <th scope="row" style="width: 20%">End Date</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%; color:#0096bb">{{ $project->end_date->format('d-M-y') }}</td>
                            </tr>

                            <tr>
                                <th scope="row" style="width: 20%">Address</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->address }}</td>
                            </tr>

                            <tr>
                                <th scope="row" style="width: 20%">City</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->city }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">District</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->district->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 20%">Postal Code</th>
                                <td colspan="" style="width: 3%">:</td>
                                <td colspan="3" style="width: 77%">{{ $project->zipCode }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-4 col-12 text-end mt-4">
                        <img src="{{ asset('upload/Project/'.$project->image) }}" alt="No Image" width="300px" height="">
                    </div>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-success p-2">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Investor Name</th>
                                    <th scope="col"> Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Installment</th>
                                    <th scope="col">Investment Total Amount</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Due Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investment as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $value ->client->name }}</td>
                                    <td>{{ $value ->client->phone }}</td>
                                    <td>{{ $value ->client->email }}</td>
                                    <td>{{ $value ->installment->count() }}</td>
                                    <td>{{ number_format($value ->total_Investment,2,'.',',') }}</td>
                                    <td>{{ number_format($value ->installment->sum('installment_amount'),2,'.',',') }} TK</td>
                                    <td>{{ number_format($value ->total_Investment - $value ->installment->sum('installment_amount'),2,'.',',') }}  TK</td>
                                </tr>
                                @endforeach                               
                            </tbody>
                            <tfoot class=" p-2">
                                <th scope="col">SL</th>
                                <th scope="col" colspan="4" class="text-center h4">Total</th>
                                <th scope="col">{{ number_format($investment->sum('total_Investment'),2,'.',',') }}</th>
                                <th scope="col">{{ number_format($investment->sum(function($data){return $data->installment->sum('installment_amount');}),2,'.',',') }} TK</th>
                                <th scope="col">{{ number_format($investment->sum('total_Investment') - $investment->sum(function($data){return $data->installment->sum('installment_amount');}),2,'.',',') }}  TK</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
