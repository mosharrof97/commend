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
                        <h3 class="mb-0"><b><u>Extra Misc Voucher</u></b></h3>
                    </center>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div style=" font-size: 17px; font-weight: 700; color:#000; "> 
                                Name: {{ $refund->flat->client->name }} 
                            </div>
                            @php
                                $address =$refund->flat->client->clientAddress;
                            @endphp
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Address: {{ $address->pre_address.', '. $address->pre_city.', '.$address->pre_district.'- '.$address->pre_zipCode}}.</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Contact No: {{ $refund->flat->client->phone }}</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; "> Booked Flat:{{ $refund->flat->project->projectName }}-{{ $refund->flat->floor }} Floor, Flat-{{ $refund->flat->name }}</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Flat Price -Tk.{{ number_format($flatSale->price, 2, '.',',') }}/-</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Total Pay -Tk.{{ number_format($payments->sum('amount'), 2, '.', ',') }}/-</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Total Extra Misc -Tk.{{ number_format($refunds->sum('amount'), 2, '.', ',') }}/-</div>
                            @php
                                $refuntAmount =$payments->sum('amount') - $refunds->sum('amount');
                            @endphp
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Net Pay Amount -Tk.{{ number_format($refuntAmount, 2, '.', ',') }}/-</div>
                            {{--<!--<div style=" font-size: 17px; font-weight: 700; color:#000; ">Due Amount -Tk.{{ number_format($flatSale->price - $refuntAmount, 2, '.', ',') }}/-</div>-->--}}
                        </div>
                        <div class="col-sm-6 " style="text-align: end">
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Date:{{ $refund->date->format('d-M-y') }}</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Extra Misc No:{{ $refund->refund_no }}</div>
                            <div style=" font-size: 17px; font-weight: 700; color:#000; ">Biller by: {{ $refund->user->name }}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    {{--  <th style=" font-size: 17px; font-weight: 700; " class="center">SL</th>  --}}
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="left strong">Details</th>
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="left strong">Payment Type</th>
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="center">Extra Misc</th>
                                    <th style=" font-size: 17px; font-weight: 700; color:#000; " class="center">Total Due Amount</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{--  <!--<td style=" font-size: 17px; font-weight: 700; color:#000; " class="center">{{$loop->iteration}}</td>-->  --}}
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="left strong">Extra Misc</td>
                                    {{--<!--<td style=" font-size: 17px; font-weight: 700; color:#000; " class="left">{{ $refund->payment_type }}</td>--> --}}
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="left">Others</td>
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="center">{{ number_format($refund->amount, 2, '.', ',') }} Taka</td>
                                    <td style=" font-size: 17px; font-weight: 700; color:#000; " class="center"> {{ number_format($flatSale->price - $refuntAmount, 2, '.', ',') }} Taka</td>
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
                {{-- <a href="{{ route('flat.sale.details',$payment->flat->id) }}" class="btn-block btn btn-danger btn-sm">back</a> --}}
            </div>
        </div>
    </div>
@endsection
