<div class="text-center">
    <img src="{{ asset('upload/CompanyInfo/'. $comInfo->logo) }}" alt="" width="150">
    <h3 class="fw-bold">{{ $comInfo->name }}</h3>
    <h5 class="fw-semibold"><b>Email: </b> {{ $comInfo->email }}</h5>
    <h4 class="fw-bold"><b>Project :</b> {{ $flatSaleInfo->flat->project->projectName }}</h4>
    <h5><b>Address:</b> {{ $flatSaleInfo->flat->project->address.', '.$flatSaleInfo->flat->project->city }}</h5>
    <h5>{{ $flatSaleInfo->flat->project->district->name.'- '.$flatSaleInfo->flat->project->zipCode}}</h5>
</div>