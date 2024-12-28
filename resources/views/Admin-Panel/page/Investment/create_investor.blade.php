@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">

        <div class="card p-4">
            <div class="card-header">
                <h4>
                    <span>Investor Information</span>
                    <a href="{{ url()->previous() }}" class="btn btn-danger ms-2">Back</a>
                </h4>
                <a href="{{ route('list_investor') }}" class="btn btn-primary">Investor List</a>
            </div>
            <div class="card-body">
                <div>
                    @if (Session::has('success'))
                    <p class="text-success">{{ Session::get('success') }}</p>
                    @endif

                    @if (Session::has('error'))
                    <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
                <form class="row g-3" action="{{ route('store_investor') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                        <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Father Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name">
                        @error('father_name')
                        <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">Mother Name</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name">
                        @error('mother_name')
                        <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone">
                        @error('phone')
                        <span id="" class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        @error('email')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nid" class="form-label">NID Number</label>
                        <input type="number" class="form-control" id="nid" name="nid">

                        @error('nid')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tin" class="form-label">TIN Number</label>
                        <input type="number" class="form-control" id="tin" name="tin">

                        @error('tin')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h4 class="text-light text-center">Address</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow-none border">
                                            <div class="card-header bg-info">
                                                <h4 class="text-light text-center">Present Address</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="mt-3">
                                                    <label for="pre_address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="pre_address" placeholder="1234 Main St" name="pre_address">
                                                    @error('pre_address')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label for="pre_city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="pre_city" name="pre_city">

                                                    @error('pre_city')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label for="pre_district" class="form-label">District</label>
                                                    <select name="pre_district" id="pre_district" class="form-select bg-light">
                                                        <option value="">Select Dristrict.......</option>
                                                        @foreach ( $districts as $district)
                                                            <option value="{{ $district->name }}">{{ $district->name }}</option>
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
                                                    <input type="text" class="form-control" id="pre_zipCode" name="pre_zipCode">

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
                                                    <input type="text" class="form-control" id="per_address" placeholder="1234 Main St" name="per_address">
                                                    @error('per_address')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label for="per_city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="per_city" name="per_city">

                                                    @error('per_city')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label for="per_district" class="form-label">District</label>
                                                    <select name="per_district" id="per_district" class="form-select bg-light">
                                                        <option value="">Select Dristrict.......</option>
                                                        @foreach ( $districts as $district)
                                                            <option value="{{ $district->name }}">{{ $district->name }}</option>
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
                                                    <input type="text" class="form-control" id="per_zipCode" name="per_zipCode">

                                                    @error('per_zipCode')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-0">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">

                        @error('image')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>

                        </div>
                    </div> --}}
                    <div class="col-12 text-end">
                        <button type="submit " class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#filladdress').change(function() {
            if ($(this).is(':checked')) {
                var pre_address = $('#pre_address').val();
                var pre_city = $('#pre_city').val();
                var pre_district = $('#pre_district').val();
                var pre_zipCode = $('#pre_zipCode').val();

                $('#per_address').val(pre_address);
                $('#per_city').val(pre_city);
                $('#per_district').val(pre_district);
                $('#per_zipCode').val(pre_zipCode);
            } else {
                $('#per_address').val('');
                $('#per_city').val('');
                $('#per_district').val('');
                $('#per_zipCode').val('');
            }
        });
    });
</script>
@endsection
