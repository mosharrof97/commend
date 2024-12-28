@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Investment List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="flex-wrap">SL</th>
                                <th scope="col" class="flex-wrap">Name</th>
                                <th scope="col" class="flex-wrap">Phone</th>
                                <th scope="col" class="flex-wrap">Email</th>
                                <th scope="col" class="flex-wrap">Project Name</th>
                                <th scope="col" class="flex-wrap">Investment Total Amount</th>
                                <th scope="col" class="flex-wrap">Installment</th>
                                <th scope="col" class="flex-wrap">Paid Amount</th>
                                <th scope="col" class="flex-wrap">Due Amount</th>
                                <th scope="col" class="flex-wrap">Action</th>
                            </tr>
                        </thead>
                        <tbody >
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
                                <td>
                                    <a href="{{route('view.investment')}} " class="btn btn-success">View</a>
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
