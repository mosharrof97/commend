<?php

namespace App\Http\Controllers\Project\Flat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Flat;
use App\Models\FlatReturnInfo;
use App\Models\FlatSaleInfo;
use App\Models\ComponyInfo;
use App\Models\PaymentReturn;
class FlatReturnController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:flat return list', ['only' => ['index']]);
    //     $this->middleware('permission:flat return', ['only' => ['returnForm','flatReturn']]);
    // }
    public function index(){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $data = [
                'returnInfo' => FlatReturnInfo::where('project_id', $project_id)->paginate(20),
                // 'PaymentReturn' => PaymentReturn::where('project_id', $project_id)->paginate(15),
            ];
            return view('Project-Panel.Flat.Flat_return.Return_list', $data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function returnForm($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $flat = Flat::where('project_id', $project_id)->where('status', '!=', 1)->find($id);

            return view('Project-Panel.Flat.Flat_return.Return',compact('flat'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function flatReturn(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $request->validate([
                'flat_id' =>[ 'required'],
                'client_id' =>[ 'required'],
                'buying_price' =>[ 'required'],
                'payable_amount' =>[ 'required'],
                
            ]);

            if($request->payment_type){

                $request->validate([
                    'payment_type' =>[ 'required'],
                    'return_amount' =>[ 'required'],
                ]);
                if($request->payment_type == 'bank' || $request->payment_type == 'check'){
                    $request->validate([
                        'bank_name' =>[ 'required'],
                        'branch' =>[ 'required'],
                        'account_number' =>[ 'required'],
                    ]);
                    if($request->payment_type == 'check'){
                        $request->validate([
                            'check_number' =>[ 'required'],
                        ]);
                    }
                }
            }

            try {
                DB::beginTransaction();
                    $data = [
                        'project_id'=>$project_id,
                        'flat_id' =>$request->flat_id,
                        'client_id' =>$request->client_id,
                        'buying_price' =>$request->buying_price,
                        'payable_amount' =>$request->payable_amount,
                        
                        'sold_by' => $request->sold_by,
                        'return_by'=>auth()->id(),
                    ];
                   $flatReturn = FlatReturnInfo::create($data);
                    
                    if($request->payment_type !== null && $request->return_amount !== null){
                        $returnAmount = [
                            'flatReturn_id'=>$flatReturn->id,
                            'payment_type' =>$request->payment_type,
                            'amount' =>$request->return_amount,

                            'bank_name' =>$request->bank_name,
                            'branch' =>$request->branch,
                            'account_number' =>$request->account_number,
                            'check_number' =>$request->check_number,
                            'received_by'=>auth()->id(),
                        ];
                       PaymentReturn::create($returnAmount);
                    }

                    $saleFlat = FlatSaleInfo::where('flat_id', $request->flat_id)->first();
                    $saleFlat->delete();

                    $flat = Flat::where('project_id', $project_id)->find($request->flat_id);
                    $update = $flat->update([
                        'client_id'=> null,
                        'sale_status'=>0,
                    ]);
                    DB::commit();
                    return redirect()->route('flat.view.chart');
                    // return redirect()->route('return.paySlip',$flatReturn->paymentReturn->id);
                
            } catch (\Exception $e) {
                DB::rollback();

                return back()->with('error','Flat Sale error: '.$e->getMessage());
            }
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }

    }

    public function view($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $project = Project::findOrFail($project_id);
            $returnInfo = FlatReturnInfo::findOrFail($id);
            $returnPayment = PaymentReturn::where('flatReturn_id',$returnInfo->id)->get();

            // dd($returnPayment);
            return view('Project-Panel.Flat.Flat_return.Return_details', compact('returnPayment','comInfo','project','returnInfo'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function payment($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $returnInfo = FlatReturnInfo::findOrFail($id);
            $comInfo = ComponyInfo::first();
            $payment = PaymentReturn::where('flat_return_id',$returnInfo->id)->get();

            return view('Project-Panel.Flat.Flat_return.Return_Payment', compact('returnInfo','comInfo','payment'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function paymentStore(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $flatReturnInfo = FlatReturnInfo::find($request->returnInfo_id);

            // dd($flatReturnInfo);
            $data = [
                // 'flat_id'=> $flatReturnInfo->flat->id,
                'flat_return_id'=> $flatReturnInfo->id,
                'payment_type'=> $request->payment_type,
                'amount'=> $request->amount,
                'bank_name'=> $request->bank_name,
                'branch'=> $request->branch,
                'account_number'=> $request->account_number,
                'check_number'=> $request->check_number,
                'received_by'=>auth()->id(),
            ];
            $payment = PaymentReturn::create($data);
        
            return redirect()->route('return.paySlip',$payment->id);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function paySlip($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::firstOrFail(); 
            $payment = PaymentReturn::findOrFail($id);
            $payments = PaymentReturn::where('flat_return_id', $payment->flat_return_id)
                               ->get();
            $flatReturn = FlatReturnInfo::findOrFail($payment->flat_return_id);

            return view('Project-Panel.Flat.Flat_return.pay_slip', compact(['payment','payments','flatReturn','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
}
