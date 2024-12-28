@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-md-3">
            <div class="card-header">
                <h4>Company Information</h4>
            </div>
            <div class="card-body">
                {{-- <div class="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $componyInfo->id }}</td>
                                <td>{{ $componyInfo->name }}</td>
                                <td>{{ $componyInfo->address }}</td>
                                <td><img src="{{ asset('upload/CompanyInfo/'.$componyInfo->logo) }}" alt="" width="40"></td>
                                <td><button class="btn btn-info">Edit</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                <div class="mt-3">
                    <form class="row g-3" action="{{ route('company.info') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('put') --}}

                        <input type="hidden" class="form-control" name="id" id="id" value="{{ $componyInfo->id }}">

                        <div class="col-xl-4 col-md-6 mt-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $componyInfo->name }}">
                        </div>

                        <div class="col-xl-4 col-md-6 mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $componyInfo->email }}">
                        </div>

                        <div class="col-xl-4 col-md-6 mt-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $componyInfo->address }}">
                        </div>

                        <div class="col-xl-4 col-md-6 mt-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                        </div>

                        <div class="col-xl-3 col-md-6 mt-3">
                            <img class="mt-3" src="{{ asset('upload/CompanyInfo/'.$componyInfo->logo) }}" alt="" width="150">
                        </div>

                        <div class=" mt-3 text-end">
                            <button type="submit" class="btn btn-info me-3 me-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
