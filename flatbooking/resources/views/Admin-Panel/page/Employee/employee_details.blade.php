@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3 class="fw-bold">Employee Details</h3>
            </div>
        </div>
        <div class="row">
            <style>
                .bg-gray {
                    background-color: #f5f5f5;
                }

            </style>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">

                        <div class="m-2 px-3 py-2 text-center">
                            <img src="{{ asset('upload/Employee/'. $employee->image) }}" alt="No image" width="200">
                        </div>

                        <div class="m-2 px-3 py-2 text-center">
                            <h4 class="fw-bold">{{ $employee->name }}</h4>
                            <h5 class="rounded" style="background-color: rgb(160, 225, 255)">{{ $employee->designation }}</h5>
                        </div>

                        <div class="m-2 px-3 py-2 rounded bg-gray">
                            <label for="">Join Date</label>
                            <h4 class="text-dark fst-italic">{{ $employee->join_date }}</h4>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-bold">Personal Information</h3>
                    </div>
                    <div class="card-body">
                        {{-- <table class="table"> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Full Name</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->name }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Birthdate</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->birthdate }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Nationality</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->nationality }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Father Name</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->father_name }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Mother Name</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->mother_name }}</h4>
                                </div>
                            </div>
                        </div>
                        {{-- </table> --}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-bold">Contact Information</h3>
                    </div>
                    <div class="card-body">
                        {{-- <table class="table"> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Email</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->email }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Phone</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->phone }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">NID</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->nid }}</h4>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="m-2 px-3 py-2 rounded bg-gray">
                                    <label for="">Nid</label>
                                    <h4 class="text-dark fst-italic">{{ $employee->nid }}</h4>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="m-2 px-3 py-2 rounded bg-gray">
                            <label for="">Mother Name</label>
                            <h4 class="text-dark fst-italic">{{ $employee->mother_name }}</h4>
                        </div>
                    </div> --}}
                </div>
                {{-- </table> --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection
