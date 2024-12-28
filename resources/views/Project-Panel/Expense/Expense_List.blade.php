@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h4>Expense List</h4>
                <a class="btn btn-primary" href="{{ route('project.expense') }}">
                    <span class="nav-text">New Expense</span>
                </a>
            </div>
            <div class="card-body">
                <div class="">
                    {{-- <table class="table"> --}}
                    <table id="projectExpenseTable" class="display nowrap" style="width:100%">
                        <thead>

                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Expense No</th>
                                <th scope="col" class="flex-wrap">Name</th>
                                <th scope="col" class="flex-wrap">Amount</th>
                                <th scope="col" class="flex-wrap">Created By</th>
                                <th scope="col" class="flex-wrap">Date</th>
                                <th scope="col" class="flex-wrap">Action</th>
                            </tr>
                        </thead>

                        <tbody >
                            @foreach ($expenses as $key => $expense )
                            <tr>
                                <th scope="row">{{  $key + 1 }}</th>
                                <td>{{ $expense->id }}</td>
                                <td>
                                    @php

                                        $names = json_decode($expense->name);
                                    @endphp
                                    @foreach($names as $key => $value)
                                        <span>{{ $value }}, </span>
                                    @endforeach
                                </td>
                                <td>{{ number_format( $expense->total,2,'.',',') }}</td>
                                {{--<td>{{ $expense->project->user->name }}</td>--}}
                                <td>{{ $expense->date }}</td>
                                <td>
                                    <a href="{{ route('project.expense.view',$expense->id) }} " class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('project.expense.edit',$expense->id) }} " class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $expenses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#projectExpenseTable', {
        layout: {
            topStart: {
                buttons: ['excel','print','pdf']
            }
        }
    }
    );
</script>
@endsection
