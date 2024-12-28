@extends('Admin-Panel.partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12">
            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Update Employee Information </h4>
                    <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">

                            @error('name')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="father_name" class="form-label">Father Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" value="{{ $employee->father_name }}">
                            @error('father_name')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="mother_name" class="form-label">Mother Name</label>
                            <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ $employee->mother_name }}">
                            @error('mother_name')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            {{-- <input type="gender" class="form-control" id="gender" name="gender"> --}}
                            <select class="form-select" name="gender" id="gender" >
                                <option value="">Select gender.......</option>
                                <option value="Male" {{ $employee->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $employee->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ $employee->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>

                            @error('gender')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $employee->nationality }}">

                            @error('nationality')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $employee->birthdate }}">

                            @error('birthdate')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="join_date" class="form-label">Join date</label>
                            <input type="date" class="form-control" id="join_date" name="join_date" value="{{ $employee->join_date }}">

                            @error('join_date')
                                <span id="" class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="phone" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
                        </div>
                        <div class="col-md-6">
                            <label for="nid" class="form-label">NID Number</label>
                            <input type="number" class="form-control" id="nid" name="nid" value="{{ $employee->nid }}">
                        </div>

                        <div class="col-md-6">
                            <label for="designation" class="form-label">Designation</label>
                            <select class="form-select" name="designation" id="designation">
                                <option value="">Select designation.....</option>
                                <option value="accountant" {{ $employee->designation == 'accountant'? 'selected':''}}>Accountant</option>
                                <option value="projectManager" {{ $employee->designation == 'projectManager'? 'selected':''}} >Project Manager</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="active_status" class="form-label">Status</label>
                            <select class="form-select" name="active_status" id="active_status">
                                <option value="active" class="text-success" {{ $employee->active_status == 'active' ? 'selected':''}}>Active</option>
                                <option value="inactive" class="text-danger" {{ $employee->active_status == 'inactive' ? 'selected':''}} >Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <br>
                            <img src="" alt="No Image" width="100" height="100">
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h4 class="text-light text-center">Address</h4>
                                </div>

                                {{-- @foreach($employee->employeeAddress as $data) --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card shadow-none border">
                                                <div class="card-header bg-info">
                                                    <h4 class="text-light text-center">Present Address</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mt-3">
                                                        {{-- @php
                                                            dd($employee->employeeAddress->pre_address);
                                                        @endphp --}}
                                                        <label for="pre_address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="pre_address" placeholder="1234 Main St" name="pre_address" value="{{ $employee->employeeAddress->pre_address }}">


                                                        @error('pre_address')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="pre_city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="pre_city"
                                                            name="pre_city" value="{{ $employee->employeeAddress->pre_city }}">

                                                        @error('pre_city')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="pre_district" class="form-label">District</label>
                                                        <select name="pre_district" id="pre_district"
                                                            class="form-select bg-light">
                                                            <option value="">Select Dristrict.......</option>

                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->name }}" {{ $employee->employeeAddress->pre_district == $district->name ? 'selected' : '' }}>{{ $district->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <div class="mr-1 ">
                                                            @error('pre_district')
                                                                <span class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="pre_zipCode" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" id="pre_zipCode"
                                                            name="pre_zipCode" value="{{ $employee->employeeAddress->pre_zipCode }}">

                                                        @error('pre_zipCode')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card shadow-none border">
                                                <div class="card-header bg-info">
                                                    <h4 class="text-light text-center">Permanent address</h4>
                                                </div>

                                                <div class="card-body">
                                                    <div class="">
                                                        <input type="checkbox" id="filladdress" name="filladdress" onclick="fillAddress()" />
                                                        <label class="form-check-label" for="filladdress">
                                                            Present address same as parmanent address.
                                                        </label>
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="per_address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="per_address"
                                                            placeholder="1234 Main St" name="per_address" value="{{ $employee->employeeAddress->per_address }}">
                                                        @error('per_address')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="per_city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="per_city"
                                                            name="per_city" value="{{ $employee->employeeAddress->per_city }}">

                                                        @error('per_city')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="per_district" class="form-label">District</label>
                                                        <select name="per_district" id="per_district"
                                                            class="form-select bg-light">
                                                            <option value="">Select Dristrict.......</option>
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->name }}" {{ $employee->employeeAddress->per_district == $district->name ? 'selected' : '' }}>
                                                                    {{ $district->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="mr-1 ">
                                                            @error('per_district')
                                                                <span class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="per_zipCode" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" id="per_zipCode"
                                                            name="per_zipCode" value="{{ $employee->employeeAddress->per_zipCode }}">

                                                        @error('per_zipCode')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>

                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
