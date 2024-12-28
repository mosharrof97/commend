<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\InvestInstallment;
use App\Models\Investment;
use App\Models\ComponyInfo;

class InstallmentController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:installment', ['only' => ['create','store']]);
    // }

    public function create(Request $request,$id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $investment = Investment::where('project_id', $project_id)->where('id',$id)->first();
            if($investment){
                $data =[
                    'comInfo' => ComponyInfo::first(),
                    'investment'=> $investment,
                    'installment'=> InvestInstallment::where('investment_id', $investment->id)->get(),
                ];
                
            }
            return view('Project-Panel.Investment.Installment.create_installment',$data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function store(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            // dd($request->all());
            if($request->payment_type == 'bank'){
                $request->validate([
                    'investment_id'=> 'required',
                    'payment_type'=> 'required',
                    'installment_amount'=> 'required',
                    'bank_name'=> 'required',
                    'branch'=> 'required',
                    'account_number'=> 'required',
                ]);
            }else if( $request->payment_type == 'check'){
                $request->validate([
                    'investment_id'=> 'required',
                    'payment_type'=> 'required',
                    'installment_amount'=> 'required',
                    'bank_name'=> 'required',
                    'check_number'=> 'required',
                ]);
            }else{
                $request->validate([
                    'investment_id'=> 'required',
                    'payment_type'=> 'required',
                    'installment_amount'=> 'required',
                ]);
            }

            $InvestInstallment = [
                'project_id'=> $project_id,
                'investment_id'=> $request->investment_id,
                'payment_type'=> $request->payment_type,
                'installment_amount'=> $request->installment_amount,
                'bank_name'=> $request->bank_name,
                'branch'=> $request->branch,
                'account_number'=> $request->account_number,
                'check_number'=> $request->check_number,
                'received_by' => auth()->id(),
            ];
           $installment = InvestInstallment::create($InvestInstallment);
            // $data = [
            //     'investment'=>Investment::where('project_id', $project_id)->where('id',$request->investment_id)->first(),
            //     'installment'=>$installment,
            //     'comInfo' => ComponyInfo::first(),
            // ];

            return redirect()->route('project.installment.payslip',$installment->id);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
        
    }

    public function payslip($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $installment = InvestInstallment::find($id);
            $data = [
                'installment'=>$installment,
                'investment'=>Investment::where('project_id', $project_id)->where('id',$installment->investment_id)->first(),            
                'comInfo' => ComponyInfo::first(),            
            ];

            return view('Project-Panel.Investment.Installment.pay_slip',$data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
}
