@extends('Admin-Panel.partial.Layout')
@section('content')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="fw-bold">Employee List</h3>
                        {{-- @can('create employee') --}}
                            <a href="{{ route('employee.create') }}" class="btn btn-primary float-end">Add Employee</a>
                        {{-- @endcan --}}
                    </div>
                    <div class="card-body">
                        {{-- <table class="table table-bordered table-striped"> --}}
                        <table id="employeeTable" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>designation</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->gender }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->active_status }}</td>
                                        <td>
                                            <img src="{{ asset('upload/employee/'.$employee->image)}}" alt="No Image" width="40">
                                        </td>
                                        <td>
                                            {{-- @can('update employee') --}}
                                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-success">Edit</a>
                                            {{-- @endcan --}}

                                            {{-- @can('update employee') --}}
                                            <a href="{{ route('employee.view', $employee->id) }}" class="btn btn-info">View</a>
                                            {{-- @endcan --}}

                                            {{-- @can('delete employee') --}}
                                            <a href="{{ route('employee.delete', $employee->id) }}" class="btn btn-info">delete</a>
                                            {{-- @endcan --}}
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
    new DataTable('#employeeTable');
</script>
@endsection
