@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">

        <div class="card p-4">
            <div class="card-header ">
                <div class="col-sm-12 text-center">
                    <h3 class=" font-weight-bold font-italic mt-3">Expense Report</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{ route('expense.report') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mt-3">
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                            </div>

                            <div class="col-lg-4 mt-3">
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                            </div>

                            <div class="col-lg-4 mt-3 ">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive bg-white mt-3" data-mdb-perfect-scrollbar="true" style="position: relative;">
                    <table class="table table-bordered" id="expense-print-body">
                        <thead>
                            <tr>
                                <th scope="col" style="min-width: 50px">SL</th>
                                <th scope="col">Expense Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created by</th>
                                <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expense as $key => $value)
                            @php
                            
                                $names = json_decode($value->name)
                            @endphp
                            <tr>
                                <th scope="row" style="min-width:50px;">{{ $key + 1 }}</th>
                                <td>{{ $value->date->format('d-M-y') }}</td>
                                <td>
                                    @foreach($names as $key => $name)
                                        <span>{{ $name }}, </span>
                                    @endforeach
                                </td>
                                <td>{{ $value->user !== null ? '$value->user->name' : ''}}</td>
                                <td>{{ $value->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" style="min-width: 50px"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Total</th>
                                <th scope="col">{{ $expense->sum('total') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $expense->links("pagination::bootstrap-5") }}
                </div>
                <div class="mt-2"><button class="btn btn-primary" id="printButton">print</button></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#printButton").click(function() {
            var originalContent = $("#body").html();
            $("#body").html($('#expense-print-body').html());
            window.print();
            $("#body").html(originalContent);
        });
    });
</script>
@endsection

