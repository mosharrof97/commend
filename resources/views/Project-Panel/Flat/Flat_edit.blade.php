@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">

        <div class="card p-4">
            <div class="card-header">
                <h3>Edit Flat Details</h3>
                <a class="btn btn-danger" href="{{ url()-> previous() }}">back</a>
            </div>
            <div class="card-body">
                <div>
                    @if (Session::has('message'))
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                    @endif

                    @if (Session::has('error'))
                        <h4 class="text-danger">{{ Session::get('error') }}</h4>
                    @endif
                </div>
                <form class="" action="{{ route('flat.update',$flat->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Flat Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $flat->name }}" placeholder="Flat Name.....">
                            @error('name')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="floor" class="form-label">Floor</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="floor" name="floor" value="{{ $flat->floor }} " placeholder="Flat Area.....">
                            @error('floor')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="flat_area" class="form-label">Flat Area</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="flat_area" name="flat_area" value="{{ $flat->flat_area }}" placeholder="Flat Area.....">
                            @error('flat_area')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Price Per squer Fit </label>
                            <span class="text-danger">*</span>
                            <input type="decimal" class="form-control" id="price" name="price" value="{{ $flat->price }}" placeholder="Price Per squer Fit.....">

                            @error('price')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="room" class="form-label">Number of Room</label>
                            <input type="number" class="form-control" id="room" name="room" value="{{ $flat->room }}" placeholder="Number of Room.....">
                            @error('room')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="dining_space" class="form-label">Dining Space</label>
                            <input type="number" class="form-control" id="dining_space" name="dining_space" value="{{ $flat->dining_space }}" placeholder="Dining space.....">
                            @error('dining_space')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="bath_room" class="form-label">Number of Bath Room</label>
                            <input type="number" class="form-control" id="bath_room" name="bath_room" value="{{ $flat->bath_room }}" placeholder="Number of Bath Room.....">
                            @error('bath_room')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="parking" class="form-label">Parking</label>
                            {{-- <input type="number" class="form-control" id="parking" name="parking" value="" placeholder="parking....."> --}}
                            <select class="form-select" name="parking" id="parking">
                                <option value="No info">No info</option>
                            </select>
                            @error('parking')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="active_status" class="form-label">Active Status</label>
                            <select class="form-select" name="active_status" id="active_status">
                                <option value="0" {{ $flat->active_status == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $flat->active_status == 1 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('active_status')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="col-md-6">
                            <label for="outdoor" class="form-label">Outdoor</label>
                            <select class="form-select" name="outdoor" id="outdoor">
                                <option value="No info">No info</option>
                            </select>
                            @error('outdoor')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-6">
                            <label for="images" class="form-label">image</label>
                            <input type="file" class="form-control" id="images" name="images[]" value="" placeholder="120 Feet Wide....." multiple>

                            @error('images')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="description" class="form-label">Flat Description</label>
                            <textarea name="description" id="description" cols="" rows="" class="form-control">{{ $flat->description }}</textarea>

                            @error('description')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <hr>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit " class="btn btn-primary ">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
