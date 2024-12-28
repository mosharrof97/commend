@extends('Admin-Panel.partial.Layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-12">

        <div class="card p-4">
            <div class="card-header">
                <h3>Investment Information</h3>
            </div>
            <div class="card-body">
                <form class="" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="investor" class="form-label">Investor</label>
                            <select name="investor_id" id="investor" class="form-select bg-light">
                                <option value="">Select Investor.......</option>
                                @foreach ( $investors as $investor)
                                <option value="{{ $investor->id }}">{{ $investor->name }}</option>
                                @endforeach
                            </select>
                            <div class="mr-1 ">
                                @error('investor_id')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Project details & Investment--}}
                        <hr>
                        <div class="col-md-12">
                            <h4>Project details</h4>

                        </div>

                        <div class="col-md-6">
                            <label for="project" class="form-label">Project Name</label>
                            <select name="project_id" id="project" class="form-select bg-light">
                                <option value="">Select Project Name.......</option>
                                @foreach ( $districts as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <div class="mr-1 ">
                                @error('project_id')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="total_Investment" class="form-label">Investment Total Amount</label>
                            <input type="decimal" class="form-control" id="total_Investment" name="total_Investment" placeholder="0.00">
                            @error('total_Investment')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="installment_type" class="form-label">Installment Type</label>
                            <select id="installment_type" class="form-select" name="installment_type">
                                <option value="">Select Installment Type.....</option>
                                <option value="fullPaid">Full Paid</option>
                                <option value="installment">Installment</option>
                            </select>
                            @error('installment_type')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="profit_type" class="form-label">Profit Type</label>
                            <select id="profit_type" class="form-select" name="profit_type">
                                <option value="">Select Profit Type.....</option>
                                <option value="percentage">percentage</option>
                                <option value="fixed">fixed</option>
                                <option value="flat">flat</option>
                            </select>
                            @error('profit_type')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="profit" class="form-label">Profit</label>
                            <input type="decimal" class="form-control" id="profit" name="profit" placeholder="0.00">
                            @error('profit')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- Project Investment Installment--}}
                        <hr>
                        <div class="col-md-12">
                            <h2> Project Investment </h2>
                        </div>

                        <div class="col-md-6">
                            <label for="installment_amount" class="form-label">Installment Amount</label>
                            <input type="text" class="form-control" id="installment_amount" placeholder="Installment amount" name="installment_amount">
                        </div>

                        <hr>
                        <div class="col-md-12">
                            <div class="my-2">
                                <h3>Installment Details</h3>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Installment</th>
                                        <th>Installment Amoune</th>
                                        <th> Due Amoune</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>01/02/2024</td>
                                        <td>1st Installment</td>
                                        <td>500000</td>
                                        <td>1000000</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"> Total Investment</td>
                                        <td colspan="">500000</td>
                                        <td colspan="">1000000</td>
                                    </tr>
                                </tbody>
                            </table>
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
