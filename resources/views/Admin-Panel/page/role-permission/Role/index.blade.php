@extends('Admin-Panel.partial.Layout')
@section('content')
    <div class="container-fluid mt-5">
        <a href="{{ route('roles.index') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-info mx-1">Permissions</a>
        <a href="{{ route('users.index') }}" class="btn btn-warning mx-1">Users</a>
    </div>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }} !</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Roles </h4>
                        @can('create role')
                        <a href="{{ route('roles.create') }}" class="btn btn-primary float-end">Add Role</a>
                        @endcan
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('roles.add.permission',$role->id) }}" class="btn btn-warning">
                                            Add / Edit Role Permission
                                        </a>

                                        @can('update role')
                                        <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success">
                                            Edit
                                        </a>
                                        @endcan

                                        @can('delete role')
                                        <a href="{{ route('roles.delete',$role->id) }}" class="btn btn-danger mx-2">
                                            Delete
                                        </a>
                                        @endcan
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
