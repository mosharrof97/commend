@extends('Admin-Panel.partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12">

<div class="card mb-4">
    <div class="card-body">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">New Vandor</h4>
                </div>
            </div>
            <form action="{{ route('vandor.store') }}" method="post" enctype="multipart/form-data" class="form-inline">
                @csrf
                <div class="form-group col-md-6 mb-3">
                    <label for="name" class="col-sm-4 col-form-label text-right">Vandor Name</label>
                    <input type="text" name="name" class="form-control col-sm-8" placeholder="Vandor Name" value="" id="name" required="">

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="phone" class="col-sm-4 col-form-label text-right">Phone Number</label>
                    <input type="text" name="phone" class="form-control col-sm-8" placeholder="Phone Number" value="" id="phone" required="">

                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6 mb-3">
                    <label for="address" class="col-sm-4 col-form-label text-right">Address</label>
                    <input type="text" name="address" class="form-control col-sm-8" placeholder="Address" id="address" required="">

                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-12 mb-3">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
