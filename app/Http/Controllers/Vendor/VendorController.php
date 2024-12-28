<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\ComponyInfo;
use App\Models\PurchaseDuePay;
use App\Models\VendorPay;

class VendorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:list vendor', ['only' => ['index','show']]);
    //     $this->middleware('permission:create vendor', ['only' => ['create','store']]);
    //     $this->middleware('permission:delete vendor', ['only' => ['destroy']]);
    // }

    public function index(){

        $vendors = Vendor::where('status', 0)->get();
        return view('Admin-Panel.page.Vendor.vendor_list', compact('vendors'));
    }

    public function create(){

        return view('Admin-Panel.page.Vendor.Add_Vendor');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:15|unique:vendors,phone',
            'address' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        Vendor::create($data);
        return redirect()->route('vendor.list')->with('message','Vendor Create Successful');;
    }


    public function show($id){
        $comInfo = ComponyInfo::first();
        $vendor = Vendor::where('status', 0)->find($id);
        $purchases = Purchase::where('vendor_id',$vendor->id)->get();
        //return $purchases;
        return view('Admin-Panel.page.Vendor.show_vendor', compact(['purchases','vendor','comInfo']));
    }

    public function payList($id){
        $comInfo = ComponyInfo::first();        
        $purchases = Purchase::find($id);
        $pay = PurchaseDuePay::where('purchase_id',$id)->get();
        $vendor = Vendor::where('status', 0)->find($purchases->vendor_id);

       // return $pay;
        return view('Admin-Panel.page.Vendor.pay-list',compact(['pay','vendor','comInfo']));
    }

    public function payDelete($id){
        try {
            DB::beginTransaction();
            $pay = PurchaseDuePay::findOrFail($id);
            $pay->delete();
            
            $purchase=Purchase::find($pay->purchase_id);

            $update=[
                'paid' => $purchase->paid - $pay->pay,
                'due' => $purchase->due + $pay->pay,
            ];
            $data = $purchase->update($update);
            //return $data;
            DB::commit();

            return back()->with('message', 'Delete Successful..!!!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('message','Due Pay error: '.$e->getMessage());
        }
    }

    public function vendorPayList($id){
        $comInfo = ComponyInfo::first();        
        $vendor = Vendor::find($id);
        $pay = VendorPay::where('vendor_id',$id)->get();
        // $vendor = Vendor::where('status', 0)->find($purchases->vendor_id);

       // return $pay;
        return view('Admin-Panel.page.Vendor.vendor-pay-list',compact(['pay','vendor','comInfo']));
    }

    public function vendorPayDelete($id){
        try {
            DB::beginTransaction();
            $pay = VendorPay::findOrFail($id);
            $pay->delete();
            
            $vendor=Vendor::find($pay->vendor_id);

            $update=[
                'paid' => $vendor->paid - $pay->pay,
                'due' => $vendor->due + $pay->pay,
            ];
            $data = $vendor->update($update);
            // return $data;
            DB::commit();

            return back()->with('message', 'Delete Successful..!!!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('message','Due Pay error: '.$e->getMessage());
        }
    }

    public function destroy($id){
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return back()-> with('message', 'Vendor Delete Successful');
    }

    public function restore($id) {
        $vendor = Vendor::withTrashed()->findOrFail($id);
        $vendor->restore();

        return redirect()->route('vendor.list')->with('message','Vendor Restore Successfully');
    }


}
