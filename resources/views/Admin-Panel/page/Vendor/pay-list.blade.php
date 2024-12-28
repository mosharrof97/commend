@extends('Admin-Panel.partial.Layout')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap');

        font-family {
            font-family: 'Nunito Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .vendor-info th,
        .vendor-info td {
            padding: 0.2rem !important;
            font-size: 15px;
            font-style: italic;
            font-family: emoji;
        }

        h2,
        h3,
        h4,
        p {
            font-style: italic;
            font-family: emoji;
        }
    </style>
    <div class="row justify-content-center font-family">
        <div class="col-lg-12 col-sm-12">
            <div class="body-content">

                <div class="row ">
                    <div class="col-md-12 contact">
                        <div class="card">
                            <div class="card-body" id="print-area">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="{{ asset('upload/CompanyInfo/' . $comInfo->logo) }}" alt=""
                                            width="100">
                                        <h2 class="fw-bold">{{ $comInfo->name }}</h2>
                                        <h4 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h4>
                                    </div>

                                    <center>
                                        <h3 class="fw-semibold"><b>Vendor: </b>{{ $vendor->name }}</h3>
                                    </center>
                                    <address class="mb-0 text-center">
                                        <p class="m-0 h4"><b>Phone: </b> {{ $vendor->phone }} </p>
                                        <p class="m-0 h4"><b>Address: </b> {{ $vendor->address }} </p>
                                    </address>
                                </div>
                                
                                <div class="table-responsive mt-5">
                                    <table id="ladger" class="table table-bordered vendor-info">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px !important;">Sl</th>
                                                <th> Date</th>
                                                <th>Debit</th>
                                                <th> Credit</th>
                                                <th> Received By</th>
                                                <th scope="col" class="flex-wrap action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pay as $key => $data)
                                                <tr>
                                                    <td style="width: 50px !important;">{{ $key + 1 }}</td>
                                                    <td>{{ $data->date->format('d-M-y') }}</td>
                                                    <td>
                                                        <font color="blue">
                                                            {{ number_format($data->pay == 0 ? 0 : $data->pay, 2, '.', ',') }}
                                                            Taka</font>
                                                    </td>
                                                    <td>
                                                        <font color="blue">
                                                            {{ number_format($data->due == 0 ? 0 : $data->due, 2, '.', ',') }}
                                                            Taka</font>
                                                    </td>
                                                    <td>
                                                        <span class="" style="color:green; font-weight: 700; font-size:14px">{{ $data->user->name }}</span>

                                                    </td>
                                                    <td class="action">
                                                        <a href="{{ route('vendor.pay.delete',$data->id) }}"  class="btn btn-light" style="background-color: #ff8a16 !important;"><i class="fa-solid fa-trash"></i></a>
                                                    </td> 
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button class="btn-block btn btn-success btn-sm" type="button"
                                onclick="printDiv('print-area')">Print</button>
                            {{-- <button class="btn-block btn btn-primary btn-sm" type="button"
                                onclick="excel('ladger')">Export as Excel</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <script>
            function exportToCsv(tableId) {
                const table = document.getElementById(tableId);
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText);

                const csvContent = headers.join(',') + '\n' +
                    rows.map(row => Array.from(row.querySelectorAll('td')).map(td => td.innerText).join(',')).join('\n');

                const encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
                const link = document.createElement('a');
                link.setAttribute('href', encodedUri);
                link.setAttribute('download', 'table_data.csv');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script> --}}
    @endsection
