<?php

namespace App\Http\Controllers\Project\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseDuePay;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use App\Models\Vendor;
use App\Models\ComponyInfo;


class PurchaseDuePayController extends Controller
{
    public function index(){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $purchaseDuePay = PurchaseDuePay::orderBy('id','desc')->get();

            return view('', compact('purchaseDuePay'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function create($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $purchase = Purchase::find($id);

            return view('Project-Panel.Purchase.Due_pay.Pay_due', compact('purchase'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function store(Request $request, $id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $request->validate([
                'date'=>'required',
                'pay'=>'required',
            ]);
            try {
                DB::beginTransaction();
                $data = [
                    'date'=>$request->date,
                    'purchase_id'=>$id,
                    'invoice_no'=>$request->invoice_no,
                    'due'=>$request->due,
                    'pay'=>$request->pay,
                    'created_by'=>auth()->id(),
                ];

                $purchaseDuePay = PurchaseDuePay::create($data);

                $purchase=Purchase::find($id);

                $update=[
                    'paid' => $purchase->paid + $purchaseDuePay->pay,
                    'due' => $purchaseDuePay->due,
                ];
                $purchase->update($update);
                // dd($update);
                DB::commit();

                return redirect()->route('project.purchase.invoice',$purchaseDuePay->id);
            } catch (\Exception $e) {
                DB::rollback();

                return back()->with('error','Due Pay error: '.$e->getMessage());
            }
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function invoice($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo =ComponyInfo::first();
            $invoice = PurchaseDuePay::find($id);

            return view('Project-Panel.Purchase.Due_pay.invoice',compact('comInfo','invoice'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
}
