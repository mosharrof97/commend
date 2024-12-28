@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Expense List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Date</th>
                                <th scope="col" class="flex-wrap">Total</th>
                                <th scope="col" class="flex-wrap">Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <th scope="row">1</th>
                                <td>20/03/2024</td>
                                <td>200000 TK</td>
                                <td>
                                    <a href="{{route('expense.view')}} " class="btn btn-success">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
