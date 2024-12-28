@extends('Admin-Panel.partial.Layout')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card p-4">
            <div class="card-header">
                <h4>Create User</h4>
                <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
            </div>
            <div class="card-body">
                <form class="row g-3" action="{{ url('users') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Full Name --}}
                    <div class="col-md-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name">

                        @error('name')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Full Name End --}}

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone">

                        @error('phone')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Phone End --}}

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">

                        @error('email')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Email End --}}

                    {{-- Password --}}
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmation Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Password End --}}

                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="">Roles</label>
                        <select name="roles[]" class="form-select" >
                            <option value="" selected>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>

                        @error('roles')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Role --}}

                    {{-- Designation  --}}
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation</label>
                        <select class="form-select" name="designation" id="designation">
                            <option value="">Select designation.....</option>
                            <option value="accountant">Accountant</option>
                            <option value="projectManager">Project Manager</option>
                        </select>

                        @error('designation')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Designation End --}}

                    {{-- Image --}}
                    <div class="col-md-12">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">

                        @error('image')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Image End --}}

                    {{-- Checkbox --}}
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                    </div>
                    {{-- Checkbox --}}
                    <div class="col-12 text-end">
                        <button type="submit " class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
