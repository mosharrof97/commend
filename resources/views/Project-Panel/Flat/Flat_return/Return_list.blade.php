@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header justify-content-center">
                <h3 class=" font-weight-bold font-italic mt-3">Sold Flat List</h3>
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

                <div class="table-responsive">
                    {{-- <table class="table border table-striped"> --}}
                    <table id="flatTable" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="" class="text-nowrap">SL</th>
                                <th rowspan="" class="text-nowrap">Client</th>
                                <th rowspan="" class="text-nowrap">Flat Name / Number</th>
                                <th rowspan="" class="text-nowrap">Floor</th>
                                <th rowspan="" class="text-nowrap">Sale price</th>
                                <th rowspan="" class="text-nowrap">Payable Amount</th>
                                <th colspan="" class="text-nowrap">Return Amount</th>
                                <th colspan="" class="text-nowrap">Return By</th>
                                <th colspan="" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($returnInfo as $key => $value)

                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $value->client->name }}</td>
                                <td>{{ $value->flat->name }}</td>
                                <td>{{ $value->flat->floor }} floor</td>
                                <td>{{ $value->buying_price }}/-</td>
                                <td>{{ $value->payable_amount - $value->paymentReturn->sum('amount') }}/-</td>
                                <td>{{ $value->paymentReturn->sum('amount') }}/-</td>
                                <td>{{ $value->returnedBy->name }}</td>
                            {{--<td>
                                    @php
                                        $images = json_decode($value->flat->images);
                                    @endphp

                                    @if($images && is_array($images))
                                        @php
                                        $image = $images[0][0];
                                        @endphp
                                            <img src="{{ asset('upload/Flat/'.$image) }}" alt="No Image" width="35" height="35">
                                    @else
                                        <p>No images found.</p>
                                    @endif
                                </td> --}}

                                <td>
                                    <a href="{{ route('return.payment.from', $value->id) }} " class="btn btn-info me-2">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route('return.view', $value->id) }} " class="btn btn-success me-2">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $returnInfo->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- -- Status Modal ----}}
{{-- <div class="modal fade" id="projectStatusModal" tabindex="-1" aria-labelledby="projectStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="projectStatusModalLabel">Update Project Status</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" action="" method="post">
                @csrf
                <label for="status">Project Status</label>
                <select class="form-select" name="status" id="status">
                    <option value="0">On Going</option>
                    <option value="1">Completed</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
              </form>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div> --}}
{{---- Status Modal -- --}}



<script>
    new DataTable('#flatTable',
        {
            layout: {
                topStart: {
                    buttons: ['excel','print']
                }
            }
        }
    );

</script>
@endsection
