<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Flat;

class ClientDashboardController extends Controller
{
    public function dashboard(){
        $authId = auth()->guard('client')->id();

        $client = Client::where('id',$authId)->first();
        $flat = Flat::where('client_id',$client->id)->get();
        $data = [
            'client' => $client,
            'flat'=> $flat,
        ];
        return view('Client-Panel.dashboard',$data);
    }
}
