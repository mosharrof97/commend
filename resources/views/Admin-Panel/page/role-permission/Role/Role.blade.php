@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">

        <div class="card ">
            <div class="card-header bg-info" >
                <h3>Add Role And Role List</h3>
            </div>
            <div class="card-body">
                {{-- <div>
                    @if (Session::has('message'))
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                    @endif

                    @if (Session::has('error'))
                        <h4 class="text-danger">{{ Session::get('error') }}</h4>
                    @endif
                </div> --}}
                <form class="" action="{{ route('store.role') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="">
                            @error('name')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit " class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-info">
                <h4>Role List</h4>
            </div>
            <div class="card-body">
                <div class=" table-responsive">
                    <table class="table border table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th rowspan="" class="text-nowrap">SL</th>
                                <th rowspan="" class="text-nowrap">Project Name</th>
                                <th colspan="4" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $roles as $key => $role )
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{route('role.view',$role->id)}} " class="btn btn-success me-2">View</a>
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
@endsection
