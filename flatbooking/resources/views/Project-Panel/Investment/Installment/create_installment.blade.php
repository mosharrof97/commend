@extends('Project-Panel.Partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">
        <div class="card mb-2 px-4">
            <div class="card-header justify-content-end p-2">
                <a href="{{ url()->previous() }}" class="btn btn-danger">back</a>

            </div>
        </div>
        <div class="card p-4">
            
            <div class="card-header flex-column justify-content-center p-4">
                <div style=" text-align: center; ">
                    <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}"
                        style="width: 200px;height: 125px;/* background: #262323; */" alt="">
                    <div style=" font-size: 23px; font-weight: 700; ">
                        <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                        <h4 class="fw-semibold"> {{ $comInfo->email }}</h4>
                        <h4 class="fw-semibold">{{ $comInfo->address }}.</h4>
                    </div>  
                    {{--  <div style=" font-size: 23px; font-weight: 700; ">Mobile : 01700-672492</div><br>  --}}
                </div>                
            </div>
            <div class="card-body">
                <div class="bg-success p-0" style="/*background-color: #ececec;*/">
                    <center>
                        <h4 class="mb-3 p-2"><b><u>Investment Information</u></b></h4>
                    </center>
                </div>
                
                <div class="table-responsive">
                    <style>
                        .table-information {
                            width: 100%;
                            margin-bottom: 1rem;
                            color: #BDBDC7;
                        }

                        .table-information th,
                        .table-information td {
                            padding: 0.2rem !important;
                        }

                    </style>
                    <table class="table-information table table-borderless">
                        <tr>
                            <th scope="row" style="width: 20%">Name </th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $investment->client->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Phone</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $investment->client->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Email</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $investment->client->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Project Name</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $investment->project->projectName }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Project Status </th>
                            <td colspan="" style="width: 3%">:</td>
                            @if ($investment->project->status == 0)
                            <td colspan="3" style="width: 77%">
                                <div class="d-flex align-items-center">
                                    <span class="bg-info p-2 me-1 rounded-circle "></span>
                                    <span class="text-info">On going</span>
                                </div>
                            </td>
                            @elseif ($investment->project->status == 1)
                            <td colspan="3" style="width: 77%">
                                <div class="d-flex align-items-center">
                                    <span class="bg-success p-2 me-1 rounded-circle">.</span>
                                    <span class="text-success">Complete</span>
                                </div>
                            </td>
                            @endif

                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Investment Total Amount</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ number_format( $investment->total_Investment,2,'.',',') }} BDT</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Installment</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ $installment->count() }} Installment</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Paid Amount</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ number_format( $installment->sum('installment_amount'),2,'.',',') }} BDT</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 20%">Due Amount</th>
                            <td colspan="" style="width: 3%">:</td>
                            <td colspan="3" style="width: 77%">{{ number_format( $investment->total_Investment - $installment->sum('installment_amount'),2,'.',',') }} BDT</td>
                        </tr>

                    </table>
                </div>
                <div class="mt-3">
                    <div class="d-flex align-items-center bg-success p-2 my-3">
                        {{-- <h4>Project Name:</h4>
                        <span class="ms-2 h6 text-dark">{{ $investment->project->projectName }}</span>--}}
                        <h4 class="m-0">Installment List</h4>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Installment</th>
                                <th scope="col">Paid Amount</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider border-dark">
                            {{-- <tbody> --}}
                            @foreach ($installment as $key => $data )
                            <tr>
                                <th scope="row" style="border-right: 1px solid #000000 !important">{{ $key + 1 }}</th>
                                <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                <td>{{ $data->created_at->format('h:i A') }}</td>
                                <td>{{ $key+1}} Installment</td>
                                <td>{{ number_format( $data->installment_amount,2,'.',',') }}</td>
                            </tr>
                            @endforeach

                            <tr class="" style="border-top: 2px solid #000000 !important">
                                <th scope="row"></th>
                                <td></td>
                                <td colspan="">
                                    <h4>Total</h4>
                                </td>
                                <td>{{ $installment->count() }} Installment</td>
                                <td>{{ number_format( $installment->sum('installment_amount') ,2,'.',',')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- <form class="" action="{{ route('store.project.installment') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" class="form-control" id="" name="investment_id" value="{{ $investment->id }}">



                </form> --}}
            </div>
        
            <div class="card-header">
                <h3>Investment Information</h3>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('store.project.installment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" id="" name="investment_id" value="{{ $investment->id }}">

                    <div class="row g-3">
                        <div class="col-md-12">
                            <h4> Project Investment </h4>
                        </div>

                        <div class="col-md-6">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select name="payment_type" id="payment_type" class="form-select">
                                <option value="">select Payment Type...........</option>
                                <option value="cash">Cash</option>
                                <option value="bank">Bank</option>
                                <option value="check">Check</option>
                            </select>

                            @error('payment_type')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="installment_amount" class="form-label">Installment Amount</label>
                            <input type="text" class="form-control" id="installment_amount" placeholder="Installment amount" name="installment_amount">

                            @error('installment_amount')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        {{--*********** Bank Details *************--}}
                        <div class="mt-3" id="bank_details" style="display: none">
                            <h4>Bank Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" placeholder="Installment amount" name="bank_name">

                                    @error('bank_name')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="branch" class="form-label">Branch</label>
                                    <input type="text" class="form-control" id="branch" placeholder="Installment amount" name="branch">

                                    @error('branch')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="number" class="form-control" id="account_number" placeholder="Installment amount" name="account_number">

                                    @error('account_number')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6" style="display: none" id="div_check_number">
                                    <label for="check_number" class="form-label">Check Number</label>
                                    <input type="number" class="form-control" id="check_number" placeholder="Installment amount" name="check_number">

                                    @error('check_number')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{--*********** Bank Details *************--}}

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

<script>
    // $(document).on('change', '#payment_type', function() {
    //     var payment_type = $(this).val();
    //     if (payment_type == 'bank') {
    //         $('#bank_details').css('display', 'block');
    //         $('#check_details').css('display', 'none');
    //     } else if (payment_type == 'check') {
    //         $('#check_details').css('display', 'block');
    //         $('#bank_details').css('display', 'none');

    //     }

    // })

    $(document).on('change', '#payment_type', function() {
        var payment_type = $(this).val();
        if (payment_type == 'bank' || payment_type == 'check' ) {
            $('#bank_details').css('display', 'block');
        }
        if (payment_type == 'check') {
            $('#div_check_number').css('display', 'block');
        }else if (payment_type == 'bank') {
            $('#div_check_number').css('display', 'none');
        }

        if (payment_type == 'cash') {
            $('#bank_details').css('display', 'none');
        }

    })

</script>
@endsection
