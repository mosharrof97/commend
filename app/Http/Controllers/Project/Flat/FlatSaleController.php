<?php

namespace App\Http\Controllers\Project\Flat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Flat;
use App\Models\Project;
use App\Models\District;
use App\Models\Client;
use App\Models\FlatSaleInfo;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\ComponyInfo;


class FlatSaleController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:flat sale', ['only' => ['index','create','flatSale','flatSaleDetails','payment','paymentStore']]);
    // }

    public function index( Request $request){

        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $project = Project::find($project_id);
            $flats = "";

            if ($request->start_date !== null && $request->end_date !== null) {
                $flats = Flat::where('project_id', $project_id)
                    ->where('status', 0)
                    ->where('sale_status', 2)
                    ->orderBy('id', 'desc')
                    ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })
                    //  ->select('id','client_id', 'floor', 'sale_status', 'name')
                    ->get()
                    ->groupBy('floor');
            } else {
                $flats = Flat::where('project_id', $project_id)
                    ->where('status', 0)
                    //  ->select('id','client_id','price', 'floor', 'sale_status', 'name')
                    ->get()
                    ->groupBy('floor');
            }

            return view('Project-Panel.Flat.Flat_sale', compact(['flats','project','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function create(Request $request, $id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $project = Project::find($project_id);
            $clients = Client::all();
            $flat = Flat::where('project_id', $project_id)->where('status', 0)->find($id);
            $comInfo = ComponyInfo::first();

            $clientInfo = '';
            if($request->client){
                $clientInfo = Client::find($request->client);
            }
            return view('Project-Panel.Flat.Flat_sale_form', compact(['flat','project','clients','clientInfo','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function flatSale( Request $request, $id){

        $project_id = Session::get('project_id');
        if($project_id !== null){
        //dd(date('Y-m-d'));
            $flat = Flat::where('project_id', $project_id)->where('status', 0)->find($id);
            try {
                DB::beginTransaction();
                $flat->update([
                    'client_id' => $request->client_id,
                    'sale_status' => 2,
                ]);

                $flatSaleInfo = FlatSaleInfo::create([
                    'flat_id' => $flat->id,
                    'price'=> $request->total_Investment,
                    'sold_by' => auth()->id(),
                ]);

                $data = [
                    'flat_id' => $flat->id,
                    'flat_sale_id' => $flatSaleInfo->id,
                    'date'=>date('Y-m-d'),
                    'payment_type' => $request->payment_type,
                    'amount' => $request->amount,
                    'bank_name'=> $request->bank_name,
                    'branch'=> $request->branch,
                    'account_number'=> $request->account_number,
                    'check_number'=> $request->check_number,
                    'received_by'=> auth()->id(),
                ];


                $payment = Payment::create($data);
                DB::commit();

                $comInfo = ComponyInfo::first();
                $flatSale = FlatSaleInfo::where('flat_id',$flat->id)->first();
                $payments = Payment::where('flat_sale_id',$flatSale->id)->get();

                // dd($payment_amount->sum('amount'));

                return redirect()->route('paySlip',$payment->id);
                // return view('Project-Panel.Flat.Voucher', compact(['payment','flatSale','comInfo','payments']));
            } catch (\Exception $e) {
                DB::rollback();

                return back()->with('error','Flat Sale error: '.$e->getMessage());
            }
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function flatSaleDetails($id){

        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $flat = Flat::find($id);
            if($flat->sale_status == 2){
                // dd($flat->flatSaleInfo);
                $flatSale = FlatSaleInfo::where('flat_id',$flat->id)->first();
                $payments = Payment::where('flat_sale_id',$flatSale->id)->get();
                $refunds = Refund::where('flat_sale_id',$flatSale->id)->get();



                return view('Project-Panel.Flat.Flat_sale_details', compact(['flat','payments','refunds','comInfo','flatSale']));
            }else{

                return redirect()->route('flat.view.chart');
            }
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function paySlip($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::firstOrFail(); 
            $payment = Payment::findOrFail($id);
           
            $conditionPayment = Payment::where('flat_sale_id',$payment->flat_sale_id)->where('id','<=',$id)->get();
            
            
            
            $payments = Payment::where('flat_sale_id', $payment->flat_sale_id)
                               ->where('flat_id', $payment->flat_id)
                               ->get();
            $refunds = Refund::where('flat_sale_id', $payment->flat_sale_id)
                        ->where('flat_id', $payment->flat_id)->where('date','<=',$payment->date)
                        ->get();
            $flatSale = FlatSaleInfo::findOrFail($payment->flat_sale_id);

            return view('Project-Panel.Flat.pay_slip', compact(['payment','payments','refunds','flatSale','comInfo','conditionPayment']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
    
    // Payment 
    public function payment($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $flatSaleInfo = FlatSaleInfo::where('flat_id',$id)->first();
            $comInfo = ComponyInfo::first();
            $payment = Payment::where('flat_sale_id',$flatSaleInfo->id)->get();
            $refunds = Refund::where('flat_sale_id', $flatSaleInfo->id)
                        ->where('flat_id', $flatSaleInfo->flat_id)
                        ->get();

            // dd($flatSaleInfo->id);
            return view('Project-Panel.Flat.Payment', compact('flatSaleInfo','comInfo','payment','refunds'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function paymentStore(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $flatSaleInfo = FlatSaleInfo::find($request->flatSaleInfo_id);
            $data = [
                'flat_id'=> $flatSaleInfo->flat->id,
                'flat_sale_id'=> $flatSaleInfo->id,
                'date'=>$request->date,
                'payment_type'=> $request->payment_type,
                'amount'=> $request->amount,
                'bank_name'=> $request->bank_name,
                'branch'=> $request->branch,
                'account_number'=> $request->account_number,
                'check_number'=> $request->check_number,
                'received_by'=>auth()->id(),
            ];
        $payment = Payment::create($data);
        // $comInfo = ComponyInfo::first();
        // $flatSale = FlatSaleInfo::find($flatSaleInfo->id);
        // $payments = Payment::where('flat_sale_id',$flatSale->id)->get();

        // dd($payments);
            return redirect()->route('paySlip',$payment->id);
            // return view('Project-Panel.Flat.invoice', compact(['payment','payments','flatSale','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function paymentDelete($id){
        $payment = Payment::find($id);
 
        $payment->delete();
 
        return back();
     }
    // Payment

    // Refund nclcakhtersalena24@gmail.com
    public function refund($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $flatSaleInfo = FlatSaleInfo::where('flat_id',$id)->first();
            $comInfo = ComponyInfo::first();
            $payment = Payment::where('flat_sale_id',$flatSaleInfo->id)->get();
            $refund = Refund::where('flat_sale_id',$flatSaleInfo->id)->get();

            // dd($flatSaleInfo->id);
            return view('Project-Panel.Flat.Refund', compact('flatSaleInfo','comInfo','payment','refund'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function refundStore(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $flatSaleInfo = FlatSaleInfo::find($request->flatSaleInfo_id);
            $data = [
                'flat_id'=> $flatSaleInfo->flat->id,
                'flat_sale_id'=> $flatSaleInfo->id,
                'date'=>$request->date,
                'payment_type'=> $request->payment_type,
                'amount'=> $request->amount,
                'bank_name'=> $request->bank_name,
                'branch'=> $request->branch,
                'account_number'=> $request->account_number,
                'check_number'=> $request->check_number,
                'received_by'=>auth()->id(),
            ];
        $refund = Refund::create($data);
        $refund->update(['refund_no'=>$refund->id + 1000]);


        // $comInfo = ComponyInfo::first();
        // $flatSale = FlatSaleInfo::find($flatSaleInfo->id);
        // $payments = Payment::where('flat_sale_id',$flatSale->id)->get();

        // dd($payments);
            return redirect()->route('refundSlip',$refund->id);
            // return view('Project-Panel.Flat.invoice', compact(['payment','payments','flatSale','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function refundDetails($id){

        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $flat = Flat::find($id);
            if($flat->sale_status == 2){
                // dd($flat->flatSaleInfo);
                $flatSale = FlatSaleInfo::where('flat_id',$flat->id)->first();
                $payments = Payment::where('flat_sale_id',$flatSale->id)->get();
                $refunds = Refund::where('flat_sale_id',$flatSale->id)->get();



                return view('Project-Panel.Flat.Refund_details', compact(['flat','payments','refunds','comInfo','flatSale']));
            }else{

                return redirect()->route('flat.view.chart');
            }
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function refundSlip($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::firstOrFail(); 
            $refund = Refund::findOrFail($id);
            $refunds = Refund::where('flat_sale_id', $refund->flat_sale_id)
                               ->where('flat_id', $refund->flat_id)
                               ->get();
            $payments = Payment::where('flat_sale_id', $refund->flat_sale_id)
                               ->where('flat_id', $refund->flat_id)
                               ->get();
            $flatSale = FlatSaleInfo::findOrFail($refund->flat_sale_id);

            return view('Project-Panel.Flat.refund_slip', compact(['refund','refunds','payments','flatSale','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function refundDelete($id){
        $refund = Refund::find($id);
 
        $refund->delete();
 
        return back();
     }
    // Refund

    
}
