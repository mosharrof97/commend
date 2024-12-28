@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4" id="PurInvoice">
            <div class="card-header justify-content-center">
                <div class="text-center ">
                    <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}" alt="" width="100">
                    <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                    <h4 class="fw-semibold"><b>Email:</b> {{ $comInfo->email }}</h4>
                    <h4 class="fw-bold"><b>Project: </b>{{ $purchase->project->projectName }}</h2>
                    <h4><b>Address:</b> {{ $purchase->project->address.', '.$purchase->project->city}}</h4>
                    <h4>{{ $purchase->project->district->name.'- '.$purchase->project->zipCode}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <h4 class="text-center fw-bold">Purchase Information</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-8 ">
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
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Project Name </h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%"> {{ $purchase->project->projectName }} </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Project Status </h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    @if ($purchase->project->status === 0)
                                        <td colspan="3" style="width: 77%">
                                            <div class="d-flex align-items-center">
                                                <span class="bg-info p-2 me-1 rounded-circle "></span>
                                                <span class="text-info">On going</span>
                                            </div>
                                        </td>
                                    @elseif ($purchase->project->status === 1)
                                        <td colspan="3" class="text-success" style="width: 77%">
                                            <div class="d-flex align-items-center">
                                                <span class="bg-info p-2 me-1 rounded-circle "></span>
                                                <span class="text-info">completed</span>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Create Purchase</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ $purchase->user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">vendor</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ $purchase->vendor == null ?  'Not Found' : $purchase->vendor->name .' - '. $purchase->vendor->phone }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Purchase Date</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ $purchase->date  }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Purchase Amount</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ number_format( $purchase->payable_amount ,2,'.',',') }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Purchase Status</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">
                                        <button class="btn btn-info">
                                            {{ $purchase->payable_amount == $purchase->paid ? 'paid' : 'Due' }}
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Paid</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ number_format($purchase->paid ,2,'.',',') }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" style="width: 20%"><h5 class="fw-bold">Due</h5></th>
                                    <td colspan="" style="width: 3%">:</td>
                                    <td colspan="3" style="width: 77%">{{ number_format($purchase->due ,2,'.',',') }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="">
                            <h4 class="fw-bold text-center"> Due Pay</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Pay By</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach($purchase->pur_due_pay as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->date }}</td>
                                        <td>{{ number_format($value->pay,2,'.',',')}}</td>
                                        <td>{{ $value->user->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Total</th>
                                        <th>{{ number_format($purchase->pur_due_pay->sum('pay'),2,'.',',') }}</th>
                                        <th>Recived By</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="">
                    @php
                        $names = json_decode($purchase->name);
                        $quantitys = json_decode($purchase->quantity);
                        $units = json_decode($purchase->unit);
                        $prices = json_decode($purchase->price);
                        $total_prices = json_decode($purchase->total_price);

                        // dd($prices);
                    @endphp
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Material Name</th>
                                <th scope="col" class="flex-wrap">Price</th>
                                <th scope="col" class="flex-wrap">Quantity & Unit</th>
                                <th scope="col" class="flex-wrap">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (  $names  as $key => $name )
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $name }}</td>
                                <td>{{ number_format($prices[$key] ,2,'.',',')}}</td>
                                <td>{{ $quantitys[$key] }} {{ $units[$key] }}</td>
                                <td>{{ number_format($total_prices[$key],2,'.',',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="4" class="text-right"> Total </td>
                                <td colspan="">{{ number_format($purchase->total,2,'.',',')  }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"> Service Charge </td>
                                <td>{{ number_format( $purchase->service_charge ,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"> Shipping Charge </td>
                                <td>{{ number_format($purchase->shipping_charge ,2,'.',',') }}</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="text-right"> Total Amount </td>
                                <td>{{ number_format( $purchase->total_amount ,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"> Discount </td>
                                <td>{{ number_format( $purchase->discount ,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"> Payable Amount </td>
                                <td>{{ number_format( $purchase->payable_amount,2,'.',',')  }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"> Paid </td>
                                <td>{{ number_format( $purchase->paid ,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"> Due </td>
                                <td>{{ number_format( $purchase->due,2,'.',',')  }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn-block btn btn-success btn-sm" type="button" onclick="printDiv('PurInvoice')">Print</button>
            <a href="{{ url()->previous() }}" class="btn-block btn btn-danger btn-sm">back</a>
        </div>
    </div>
</div>

@endsection
