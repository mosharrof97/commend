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
                <h4>Edit User</h4>
                <a href="{{ route('users.index') }}" class="btn btn-danger float-end">Back</a>
            </div>
            <div class="card-body">
                <form class="row g-3" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- Full Name --}}
                    <div class="col-md-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">

                        @error('name')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Full Name End --}}

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">

                        @error('phone')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Phone End --}}

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">

                        @error('email')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Email End --}}


                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="">Roles</label>
                        <select name="roles[]" class="form-select">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option
                                value="{{ $role }}"
                                {{ in_array($role, $userRoles) ? 'selected':'' }}
                            >
                                {{ $role }}
                            </option>
                            @endforeach
                        </select>

                        @error('roles')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Role End --}}

                    {{-- Designation --}}
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
                    <div class="col-md-8">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">

                        @error('image')
                            <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <img src="" alt="No Image" width="100" class="border border-2">
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
                    {{-- Checkbox End --}}
                    <div class="col-12 text-end">
                        <button type="submit " class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
