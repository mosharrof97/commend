@extends('Project-Panel.Partial.Layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4>Flat Chart</h4>
                    <div class="d-flex">
                        <form class="d-flex" action="{{ route('flat.view.chart') }}" method="get">
                            @csrf
                            <div class="me-2">
                                <input type="date" class="form-control" name="start_date" id="start_date">
                            </div>
                            <div class="me-2">
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                            <div class="me-2">
                                <button type="submit" class="btn btn-info">Filter</button>
                            </div>

                        </form>
                        <a class="btn btn-info ms-2" href="{{ route('flat.sold') }}">
                            <span class="nav-text">Sold Flat</span>
                        </a>
                        <a class="btn btn-primary ms-2" href="{{ route('flat.add') }}">Add New Flat</a>
                    </div>

                </div>
                <div class="card-body">
                    <div>
                        @if (Session::has('message'))
                            <h4 class="text-success ">{{ Session::get('message') }}</h4>
                        @endif

                        @if (Session::has('error'))
                            <h4 class="text-danger">{{ Session::get('error') }}</h4>
                        @endif
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="text-center">
                                <img src="{{ asset('upload/CompanyInfo/' . $comInfo->logo) }}" alt=""
                                    width="100">
                                <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                                <h4 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h4>
                                <h4 class="fw-bold"><b>Project: </b> {{ $project->projectName }}</h4>
                                <h5><b>Address: </b>
                                    {{ $project->address . ', ' . $project->city }}</h5>
                                <h5>{{ $project->district->name . '- ' . $project->zipCode }}</h5>

                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <h4 class="fw-bold" style="text-decoration: underline">Flat Chart</h2>
                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12 border py-3 text-center mt-2">
                            @if ($flats !== null)
                                @foreach ($flats as $floor => $floorFlats)
                                    <h5 class="fw-bold mt-2 mb-0">Floor: {{ $floor }}</h5>
                                    @foreach ($floorFlats as $flat)
                                        @if ($flat->sale_status == 0)
                                            <a href="{{ route('flat.sale.form', $flat->id) }}" 
                                                class="btn btn-success rounded my-1" style="width:150px; height:70px;">
                                                {{ $flat->name }}
                                                {{-- <h6 class="text-light"><b>Price : </b>{{ $flat->price }}</h6> --}}
                                            </a>
                                        @elseif($flat->sale_status == 1)
                                            <a href="{{ route('booking_view', $flat->id) }}"
                                                class="btn btn-warning rounded my-1">{{ $flat->name }}</a>
                                        @elseif($flat->sale_status == 2)
                                            <a href="{{ route('flat.sale.details', $flat->id) }}"
                                                class="btn btn-danger rounded my-1 " style="width:150px; height:70px; ">
                                                {{ $flat->name }}
                                                <h6 class="text-light"><b>Client : </b>{{ $flat->client->name }}</h6>
                                            </a>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <h5 class="fw-bold mt-2 mb-0">No Data Found!</h5>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
