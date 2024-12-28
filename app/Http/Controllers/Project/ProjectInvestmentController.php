<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Investment;
use App\Models\InvestInstallment;
use App\Models\Client;
use App\Models\ComponyInfo;
use Auth;


class ProjectInvestmentController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:view investment', ['only' => ['index']]);
    //     $this->middleware('permission:create investment', ['only' => ['create','store']]);
    //     $this->middleware('permission:show investment', ['only' => ['show']]);
    // }

    public function index(){
        $project_id = Session::get('project_id');
        if($project_id !== null){          

            $data = [
                'invest' => Investment::where('project_id', $project_id)
                            ->whereHas('client', function ($query) {
                                $query->whereNull('deleted_at');
                            })
                            ->orderBy('id','desc')
                            ->paginate(15),
            ];
            
            return view('Project-Panel.Investment.investmentList',$data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function create(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $data =[
                'clients'=> Client::get(),
                ];
            return view('Project-Panel.Investment.create_investment',$data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function store(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $request->validate([
                'total_Investment'=> 'required',
                'installment_type'=> 'required',
                'profit_type'=> 'required',
                'profit'=> 'required',
                'payment_type'=>'required',
                'installment_amount'=> 'required',
            ]);
            // dd($request->all());
            try {
                DB::beginTransaction();

                $data=[
                    'client_id' => $request->client_id,
                    'project_id'=> $project_id,
                    'total_Investment'=> $request->total_Investment,
                    'installment_type'=> $request->installment_type,
                    'profit_type'=> $request->profit_type,
                    'profit'=> $request->profit,
                    'created_by'=> Auth::id(),
                ];

                $investment = Investment::create($data);
                $InvestInstallment = [
                    'project_id'=>$project_id,
                    'investment_id'=> $investment->id,
                    'payment_type'=> $request->payment_type,
                    'installment_amount'=> $request->installment_amount,
                    'bank_name'=> $request->bank_name,
                    'branch'=> $request->branch,
                    'account_number'=> $request->account_number,
                    'check_number'=> $request->check_number,
                ];
                
                $installment = InvestInstallment::create($InvestInstallment);
                
                // $data = [
                //     'investment'=>$investment,
                //     'installment'=>$installment,
                //     'comInfo' => ComponyInfo::first(),
                // ];

                DB::commit();
                return redirect()->route('project.investment.payslip',$investment->id);

            } catch (\Exception $e) {
                DB::rollback();

                return back()->with('error','Investment error: '.$e->getMessage());
            }
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function payslip($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $investment = Investment::find($id);
            $installment = InvestInstallment::where('investment_id',$investment->id)->first();   
            // dd($installment);         
            $data = [
                'investment'=>$investment,
                'installment'=>$installment,
                'comInfo' => ComponyInfo::first(),
            ];
            return view('Project-Panel.Investment.pay_slip', $data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function show($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $investment = Investment::where('project_id', $project_id)->where('id',$id)->first();
            // dd($investment);
            if($investment){
                $data =[
                    'comInfo' => ComponyInfo::first(),
                    'investment'=> $investment,
                    'installment'=> InvestInstallment::where('investment_id', $investment->id)->get(),
                ];

                return view('Project-Panel.Investment.investment_view', $data);
            } else {
                return back()->with('error', 'No investment Data found for this project.');
            }
        } else {
            return redirect()->route('list.project')->with('error', 'Project Id Is Null');
        }
    }


}
