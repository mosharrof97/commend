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
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Users </h4>
                    @can('create user')
                    <a href="{{ route('users.create') }}" class="btn btn-primary float-end">Add User</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->designation }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('update user')
                                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success">Edit</a>
                                        @endcan

                                        @can('delete user')
                                        <a href="{{ route('users.delete',$user->id) }}" class="btn btn-danger mx-2">Delete</a>
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
</div>

@endsection
