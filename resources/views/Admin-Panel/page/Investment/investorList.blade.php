@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Investor List</h3>
                <a href="{{ route('create_investor') }}" class="btn btn-primary"> Add Investor</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-nowrap">SL</th>
                                <th scope="col" class="text-nowrap">Name</th>
                                <th scope="col" class="text-nowrap">Photo</th>
                                <th scope="col" class="text-nowrap">Father Name</th>
                                <th scope="col" class="text-nowrap">Mother Name</th>
                                <th scope="col" class="text-nowrap">Phone</th>
                                <th scope="col" class="text-nowrap">NID Number</th>
                                <th scope="col" class="text-nowrap">TIN Number</th>
                                <th scope="col" class="text-nowrap">Email</th>
                                <th scope="col" class="text-nowrap">Present Address</th>
                                <th scope="col" class="text-nowrap">Permanent address</th>
                                <th scope="col" class="text-nowrap">Total Invest Project</th>
                                <th scope="col" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $datas as $key => $data )
                            <tr>
                                <th scope="row" class="">{{ $key+1 }}</th>
                                <td>{{ $data->name }}</td>
                                <td><img src="{{ asset('upload/Investor/'.$data->image) }}" alt="" width="40"></td>
                                <td>{{ $data->father_name }}</td>
                                <td>{{ $data->mother_name }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->nid }}</td>
                                <td>{{ $data->tin }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->pre_address }}, {{ $data->pre_city }}, {{ $data->pre_district }} -{{ $data->pre_zipCode }} </td>
                                <td>{{ $data->per_address }}, {{ $data->per_city }}, {{ $data->per_district }} -{{ $data->per_zipCode }} </td>
                                <td>3 Project</td>
                                <td>
                                    <a href="{{route('investor.view',$data->id)}}" class="btn btn-success">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="">
                    {{-- {!! $data->withQueryString()->links('pagination::bootstrap-5') !!} --}}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
