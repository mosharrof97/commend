@extends('Project-Panel.Partial.Layout')
@section('content')
    
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
            <div class="card" id="printArea">
                <div class="card-header flex-column justify-content-center p-4">
                    <div style=" text-align: center; ">
                        {{--  @php
                            dd($comInfo);
                        @endphp--}}
                        <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}"
                            style="width: 200px;height: 125px;/* background: #262323; */" alt="">
                        <div style=" font-size: 23px; font-weight: 700; ">
                            <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                            <h4 class="fw-semibold"> {{ $comInfo->email }}</h4>
                            <h4 class="fw-semibold">{{ $comInfo->address }}.</h4>
                        </div>  
                        {{--  <div style=" font-size: 23px; font-weight: 700; ">Mobile : 01700-672492</div><br>  --}}
                    </div>

                    <center>
                        <h3 class="mb-0"><b><u>Payment Voucher</u></b></h3>
                    </center>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div style=" font-size: 17px; font-weight: 700; color:#000; "> 
                                Name: {{ $payment->flat->client->name }} 
                            </div>
                            @php
                                $address =$payment->flat->client->clientAddress;
                            @endphp
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Address: {{ $address->pre_address.', '. $address->pre_city.', '.$address->pre_district.'- '.$address->pre_zipCode}}.</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Contact No: {{ $payment->flat->client->phone }}, {{ $payment->flat->project->projectName }}-{{ $payment->flat->floor }}, Flat-{{ $payment->flat->name }},
                                Unit price -Tk.{{ number_format($flatSale->price,2,'.',',' ) }}/- 
                            </div>
                        </div>
                        <div class="col-sm-6 " style="text-align: end">
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Date:{{ $payment->created_at->format('d-M-y') }}</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Payment No:{{ $payment->id + 500 }}</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Biller by: {{ $payment->received_by }}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    {{--  <th style=" font-size: 17px; font-weight: 700; " class="center">SL</th>  --}}
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="left strong">Details</th>
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="left">Paid</th>
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="center">Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{--  <td style=" font-size: 17px; font-weight: 700; color:#000; " class="center">{{$loop->iteration}}</td>  --}}
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="left strong">Payment Paid</td>
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="left">{{ number_format($payment->amount,2,'.',',' ) }} Taka</td>
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="center">{{ number_format($flatSale->price -$payments->sum('amount'),2,'.',',' ) }} Taka1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">


                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <br><br>
                    <table style="width:90%;margin-left: 31px;">
                        <tbody>
                            <tr>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"><span
                                        style="border-top: 1px solid #000;padding-top: 4px;font-size: 17px;font-weight: 900; color:#000;">Prepared
                                        by</span></td>
                                <td style="text-align: center;"><span
                                        style="border-top: 1px solid #000;padding-top: 4px;font-size: 17px;font-weight: 900; color:#000;">Recived
                                        by</span></td>

                                <td style="text-align: center;"><span
                                        style="border-top: 1px solid #000;padding-top: 4px;font-size: 17px;font-weight: 900; color:#000;">
                                        Customer Signature </span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="">
                <button class="btn-block btn btn-success btn-sm" type="button" onclick="printDiv('printArea')">Print</button>
                <a href="{{ url()->previous() }}" class="btn-block btn btn-danger btn-sm">back</a>
            </div>
        </div>
    </div>
@endsection
