<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\VendorPay;
use App\Models\Purchase;
use App\Models\Vendor;
use App\Models\ComponyInfo;

class VendorDuePayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create($id){
        
        $vendor = Vendor::find($id);

        return view('Admin-Panel.page.Vendor.due_pay.Pay_due', compact('vendor'));
       
    }

    public function store(Request $request, $id){
        
        $request->validate([
            'date'=>'required',
            'due' =>'required',
            'pay'=>'required',
        ]);

        // dd($request->all());
        try {
            DB::beginTransaction();

            $vendor=Vendor::find($id);
            $data = [
                'date'=>$request->date,
                'vendor_id'=>$id,
                // 'total_amount' => $vendor->payable_amount,
                // 'payable_amount' => $vendor->due,
                'pay'=>$request->pay,
                'due'=>$request->due,
                'created_by'=>auth()->id(),
            ];

            $duePay = VendorPay::create($data);

            // dd($vendor);
            $update=[
                'paid' => $vendor->paid + $duePay->pay,
                'due' => $vendor->due - $request->pay,
            ];
            $vendor->update($update);
            // dd($update);
            DB::commit();

            return redirect()->route('vendor.purchase.invoice',$duePay->id);
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error','Due Pay error: '.$e->getMessage());
        }        
    }

    public function invoice($id){
        
        $comInfo =ComponyInfo::first();
        $invoice = VendorPay::find($id);

        return view('Admin-Panel.page.Vendor.due_pay.invoice',compact('comInfo','invoice'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
