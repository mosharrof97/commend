<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\District;
use App\Models\ClientAddress;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\Flat;
use DB;

class ClientController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:list client', ['only' => ['index','view']]);
    //     $this->middleware('permission:create client', ['only' => ['create','store','update','edit']]);
    //     $this->middleware('permission:delete client', ['only' => ['destroy']]);
    // }

    public function index() {
        $client = Client::where('status',0)->get();
        return view('Admin-Panel.page.Client.client_list', ['clients' => $client]);
    }

    public function create() {
        $districts = District::get();
        return view('Admin-Panel.page.Client.client', ['districts'=>$districts]);
    }

    public function store(Request $request) {
        
        

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|max:15|unique:employees,phone',
            'email' => 'required|email|max:255|unique:employees,email',
            // 'father_name' => 'required|string|max:255',
            // 'mother_name' => 'required|string|max:255',
            // 'nid' => 'required|max:20|unique:clients,nid',
            // 'tin' => 'required|max:20|unique:clients,tin',,
            // 'image' => 'required',

            // 'pre_address' => 'required|string|max:255',
            // 'pre_city' => 'required|string|max:255',
            // 'pre_district' => 'required|string|max:255',
            // 'pre_zipCode' => 'required',

            // 'per_address' => 'required|string|max:255',
            // 'per_city' => 'required|string|max:255',
            // 'per_district' => 'required|string|max:255',
            // 'per_zipCode' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'Client_' . time() . '_' . mt_rand(100000, 9999999999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('upload/client'), $imageName);
        }

        try {
            DB::beginTransaction();
            $client= Client::create([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'nid' => $request->nid,
                'tin' => $request->nid,
                'password' => 123456789,
                'image'=> $imageName,
                'created_by' => auth()->id(),
            ]);

            $data = ClientAddress::create([
                'client_id' => $client->id,
                'pre_address' => $request->pre_address,
                'pre_city' => $request->pre_city,
                'pre_district' => $request->pre_district,
                'pre_zipCode' => $request->pre_zipCode,

                'per_address' => $request->per_address,
                'per_city' => $request->per_city,
                'per_district' => $request->per_district,
                'per_zipCode' => $request->per_zipCode,
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('client.list')->with('status','Client created successfully with roles');
    }

    public function edit(Request $request, $id) {
        $districts = District::get();
        $client = Client::where('id',$id)->first();

        return view('Admin-Panel.page.Client.client_edit', [
            'client' => $client,
            'districts' => $districts,
        ]);
    }

    public function update(Request $request, $id) {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required',
            // 'father_name' => 'required|string|max:255',
            // 'mother_name' => 'required|string|max:255',
            // 'nid' => 'required',
            // 'tin' => 'required',
            // 'image' => 'required',

            // 'pre_address' => 'required|string|max:255',
            // 'pre_city' => 'required|string|max:255',
            // 'pre_district' => 'required|string|max:255',
            // 'pre_zipCode' => 'required',

            // 'per_address' => 'required|string|max:255',
            // 'per_city' => 'required|string|max:255',
            // 'per_district' => 'required|string|max:255',
            // 'per_zipCode' => 'required',
        ]);
       

        try {
            DB::beginTransaction();
            $client = Client::find($id);
            
           // Update the client
            if ($request->hasFile('image')) {
                // Store the new image
                $imageName = 'Client_' . time() . '_' . mt_rand(100000, 9999999999) . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('upload/client'), $imageName);
            
                // Delete the old image if it exists
                if ($client->image) {
                    $oldImagePath = public_path('upload/client/' . $client->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                // Update the client
                $client->update([
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'nid' => $request->nid,
                    'tin' => $request->tin,
                    'image' => $imageName,
                    'updated_by' => auth()->id(),
                ]);
            } else {
                $client->update([
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'nid' => $request->nid,
                    'tin' => $request->tin,
                    'updated_by' => auth()->id(),
                ]);
            }

            // Find the client's address
            $address = ClientAddress::where('client_id', $client->id)->first();
            
            if ($address) {
                $address->update([
                    'pre_address' => $request->pre_address,
                    'pre_city' => $request->pre_city,
                    'pre_district' => $request->pre_district,
                    'pre_zipCode' => $request->pre_zipCode,

                    'per_address' => $request->per_address,
                    'per_city' => $request->per_city,
                    'per_district' => $request->per_district,
                    'per_zipCode' => $request->per_zipCode,
                ]);
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('client.list')->with('status','User Updated Successfully with roles');
    }

    public function view($id) {
        $client = Client::where('status', 0)->where('id', $id)->first();
    
        if (!$client) {
            abort(404, 'Client not found');
        }
    
        $flats = Flat::where('client_id', $client->id)->get();
        $flatIds = $flats->pluck('id'); 
        $payments = Payment::whereIn('flat_id', $flatIds)->get();
        $refunds = Refund::whereIn('flat_id', $flatIds)->get();
    
        return view('Admin-Panel.page.Client.client_details', [
            'client' => $client,
            'flats' => $flats,
            'payments' => $payments,
            'refunds' => $refunds
        ]);
    }

    public function delete($id) {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('client.list')->with('status','Client Delete Successfully');
    }

    public function restore($id) {
        $client = Client::withTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('client.list')->with('status','Client Restore Successfully');;
    }
}
