@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Client List</h3>
                <a href="{{ route('client.create') }}" class="btn btn-primary">Add Client</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <table class="table table-striped"> --}}
                    <table id="claintTable" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" class="text-wrap">SL</th>
                                <th scope="col" class="text-wrap">Name</th>
                                <th scope="col" class="text-wrap">Phone</th>
                                <th scope="col" class="text-wrap">Email</th>
                                <th scope="col" class="text-wrap">NID</th>
                                <th scope="col" class="text-wrap">Flat Booking</th>
                                <th scope="col" class="text-wrap">Image</th>
                                <th scope="col" class="text-wrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $key => $client)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->nid }}</td>
                                <td>{{ $client->flat->where('client_id',$client->id )->count() }} Flat</td>
                                <td> <img src="{{ asset('upload/client/'.$client->image) }}" alt="" width="40"> </td>

                                <td>
                                    <a href="{{route('client.view', $client->id)}}" class="btn btn-success">View</a>
                                    <a href="{{route('client.edit', $client->id)}}" class="btn btn-success">Edit</a>
                                
                                    <a href="{{route('client.delete', $client->id)}}" class="btn btn-danger">Delete</a>
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
    new DataTable('#claintTable', {
        layout: {
            topStart: {
                buttons: ['pdf', 'print']
            }
        }
    });
</script>
@endsection
