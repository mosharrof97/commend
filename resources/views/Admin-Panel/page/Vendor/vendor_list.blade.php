@extends('Admin-Panel.partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12">
            <div class="card p-4">
                <div class="card-header">
                    <h3>
                        <strong>Vandor List</strong>
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                    </h3>
                    <a href="{{ route('vendor.create') }}" class="btn btn-primary">Add vandor</a>
                </div>
                <div class="card-body">
                    <div>
                        @if (Session::has('message'))
                            <h4 class="text-success ">{{ Session::get('message') }}</h4>
                        @endif

                        @if (Session::has('error'))
                            <h4 class="text-danger">{{ Session::get('error') }}</h4>
                        @endif
                    </div>
                    <div class="table-responsive">
                        {{-- <table class="table table-striped"> --}}
                        <table id="vendorTable" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-wrap">SL</th>
                                    <th scope="col" class="text-wrap">Name</th>
                                    <th scope="col" class="text-wrap">Phone</th>
                                    <th scope="col" class="text-wrap">Address</th>
                                    <th scope="col" class="text-wrap">Total Purchase</th>
                                    <th scope="col" class="text-wrap">Total Pay</th>
                                    <th scope="col" class="text-wrap">Total Due</th>
                                    <th scope="col" class="text-wrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $key => $vendor)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->phone }}</td>
                                    <td>{{ $vendor->address }}</td>
                                    <td>{{ $vendor->payable_amount }} tk</td>
                                    <td>{{ $vendor->paid }} tk</td>
                                    <td>{{ $vendor->due }} tk</td>
                                    <td>
                                        @if ($vendor->due > 0)
                                        <a href="{{route('vendor.purchase.due.pay', $vendor->id)}}" class="btn btn-primary">due</a>
                                        @endif                                        
                                        <a href="{{route('vendor.all.pay.list', $vendor->id)}}" class="btn btn-success">Memo list</a>
                                        <a href="{{route('vendor.delete', $vendor->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        <a href="{{route('vendor.view', $vendor->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#vendorTable'
        // , {
        //     layout: {0..
        //         topStart: {
        //             buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        //         }
        //     }
        // }
        );
    </script>
@endsection
