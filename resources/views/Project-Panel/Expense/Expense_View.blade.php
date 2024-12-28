@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header bg-info">
                <h3>Expense Details</h3>
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
                            <td colspan="3" style="width: 77%"> {{ $expense->project->projectName }} </td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Project Status </th>
                            <td colspan="" style="width: 3%">:</td>
                            @if ($expense->project->status === 0)
                                <td colspan="3" style="width: 77%">
                                    <div class="d-flex align-items-center">
                                        <span class="bg-info p-2 me-1 rounded-circle "></span>
                                        <span class="text-info">On going</span>
                                    </div>
                                </td>
                            @elseif ($expense->project->status === 1)
                                <td colspan="3" class="text-success" style="width: 77%">
                                    <div class="d-flex align-items-center">
                                        <span class="bg-info p-2 me-1 rounded-circle "></span>
                                        <span class="text-info">completed</span>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Create expense</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $expense->user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">expense Date</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $expense->date  }}</td>
                        </tr>

                    </table>
                </div>
                <div class="">
                    @php
                        $names = json_decode($expense->name);
                        $quantitys = json_decode($expense->quantity);
                        $prices = json_decode($expense->price);
                        $total_prices = json_decode($expense->total_price);

                        // dd($prices);
                    @endphp
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Material Name</th>
                                <th scope="col" class="flex-wrap">Price</th>
                                <th scope="col" class="flex-wrap">Quantity</th>
                                <th scope="col" class="flex-wrap">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (  $names  as $key => $name )
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $name }}</td>
                                <td>{{ number_format( $prices[$key],2,'.',',') }}.00</td>
                                <td>{{ $quantitys[$key] }}</td>
                                <td>{{ number_format( $total_prices[$key] ,2,'.',',')}}.00</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"> Total </td>
                                <td colspan="">{{ number_format( $expense->total ,2,'.',',') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-danger">back</a>
            </div>
        </div>
    </div>
</div>

@endsection
