<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Project;
use App\Models\Flat;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Investment;
use App\Models\InvestInstallment;


class ProjectDashboardController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:login project', ['only' => ['index']]);
    //     $this->middleware('permission:logout project', ['only' => ['sessionDelete']]);
    // }

    
    public function index(Request $request,$id){

        $request->session()->put('project_id',$id);
        $sessiondata = $request->session()->get('project_id');

       $project_id = Session::get('project_id');
        if($project_id !== null){

            $flat = Flat::where('project_id', $project_id)->where('status', 0);
            $purchase = Purchase::where('project_id', $project_id)->get();
            
            $data = [
                'project' => Project::where('id', $project_id)->first(),
                'allFlat' => $flat->count(),
                'under_contraction_flat' => $flat->clone()->where('active_status', 1)->count(),
                'complete_flat' => $flat->clone()->where('active_status', 0)->count(), 
                'unsold_flat' => $flat->clone()->where('sale_status', 0)->count(),
                'sold_flat' => $flat->clone()->where('sale_status', 2)->count(),
                'total_client' => $flat->clone()->distinct('client_id')->count(),
                'totalPurchase' => $purchase->sum('total_amount'),
                'paidPurchase' => $purchase->sum('paid'),
                'duePurchase' => $purchase->sum('due'),
                'investor'=>Investment::where('project_id', $project_id)->distinct('client_id')->count(),
                'total_invest'=>InvestInstallment::where('project_id', $project_id)->sum('installment_amount'),
            ];



            return view('Project-Panel.dashboard', $data);
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function sessionDelete(Request $request){
       $project_id = Session::get('project_id');
        if($project_id !== null){
            // Session::flush($project_id);
            Session::forget('project_id');
            return redirect()->route('list.project');
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
}
