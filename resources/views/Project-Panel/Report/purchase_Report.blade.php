@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11 col-sm-12">

        <div class="card p-4" >
            <div class="card-header ">
                <div class="col-sm-12 text-center">
                    <h3 class=" font-weight-bold font-italic mt-3">Purchase Report</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{ route('purchase.report') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mt-3">
                                <select name="name" id="name" class="form-select" value="{{ old('name') }}">>
                                    <option value="">All Vendor</option>
                                    @foreach($vendor as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option >
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 mt-3">
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                            </div>

                            <div class="col-lg-4 mt-3">
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                            </div>

                            <div class="col-lg-12 mt-3 text-end">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                
                <div id="PurInvoice">
                    {{--<!--<div class="col-sm-12 text-center">
                        <h3 class=" font-weight-bold font-italic mt-3">Purchase Report</h3></div>-->--}}
                    <div class="table-responsive bg-white mt-3" data-mdb-perfect-scrollbar="true" style="position: relative;">
                        <table class="table table-bordered" id="expense-print-body">
                            <thead>
                                <tr>
                                    <th scope="col" style="min-width: 50px">SL</th>
                                    <th scope="col">Purchase Date</th>
                                    <th scope="col">Created by</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Paid</th>
                                    <th scope="col">Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase as $key => $value)
                                @php
    
                                    $names = json_decode($value->name)
                                @endphp
                                <tr>
                                    <th scope="row" style="min-width:50px;">{{ $key + 1 }}</th>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->user->name}}</td>
                                    <td>
                                        @foreach($names as $key => $name)
                                            <span>{{ $name }}, </span>
                                        @endforeach
                                    </td>
                                    <td>{{ $value->payable_amount}}</td>
                                    <td>{{ $value->paid}}</td>
                                    <td>{{ $value->due}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" style="min-width: 50px"></th>
                                    <th scope="col" colspan="3" class="text-end">Total</th>
                                    <th scope="col">{{ $purchase->sum('payable_amount') }}</th>
                                    <th scope="col">{{ $purchase->sum('paid') }}</th>
                                    <th scope="col">{{ $purchase->sum('due') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $purchase->links("pagination::bootstrap-5") }}
                </div>
            </div>
            <div class="card-footer">
                <button class="btn-block btn btn-success btn-sm" type="button" onclick="printDiv('PurInvoice')">Print</button>
                <a href="{{ url()->previous() }}" class="btn-block btn btn-danger btn-sm">back</a>
            </div>
        </div>
    </div>
</div>
@endsection
