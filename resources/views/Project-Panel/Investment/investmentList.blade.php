@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-sm-12">
        <div class="card p-4">
            <div class="card-header">
                <h3>Investment List</h3>
                 <a class="btn btn-facebook" href="{{ route('create.project.investment') }}">
                    <i class="fa-solid fa-store"></i>
                    <span class="nav-text">New Invest</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display nowrap" style="width:100%" id="investTable">
                        <thead>
                            <tr>
                                <th  class="" style="min-width: 50px">SL</th>
                                <th scope="col" class="flex-wrap">Name</th>
                                <th scope="col" class="flex-wrap">Phone</th>
                                <th scope="col" class="flex-wrap">Email</th>
                                <th scope="col" class="flex-wrap">Project Name</th>
                                <th scope="col" class="flex-wrap">Investment Total Amount</th>
                                {{-- <th scope="col" class="flex-wrap">Installment</th> --}}
                                <th scope="col" class="flex-wrap">Paid Amount</th>
                                <th scope="col" class="flex-wrap">Due Amount</th>
                                <th scope="col" class="flex-wrap">Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @if($invest->count() > 0 )
                                @foreach ( $invest as $key => $data )
                                <tr>
                                    <th scope="row" style="min-width: 50px">{{ $key + 1 }}</th>
                                    <td>{{ $data->client->name }}</td>
                                    <td>{{ $data->client->phone }}</td>
                                    <td>{{ $data->client->email }}</td>
                                    <td>{{ $data->project->projectName }}</td>
                                    <td>{{ number_format( $data->total_Investment,2,'.',',')}}</td>
                                    <td>{{ number_format( $data->installment->sum('installment_amount'),2,'.',',') }}</td>
                                    
                                    <td>{{$data->total_Investment - $data->installment->sum('installment_amount') }}</td>
                                    <td>
                                        <a href="{{ route('project.investment.view',$data->id) }}" class="btn btn-success">View</a>

                                        @if($data->total_Investment == $data->installment->sum('installment_amount'))
                                        <button class="btn btn-danger">paid</button>
                                        @else
                                        <a href="{{ route('project.installment',$data->id) }}" class="btn btn-success">Installment</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="">
                                        <h4>No Data Found</h4>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $invest->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    new DataTable('#investTable',
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
