<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\Project;
use App\Models\Investment;
use App\Models\InvestInstallment;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\FlatSaleInfo;
use App\Models\Flat;
use App\Models\Payment;
use DB;

class ProjectReportController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:project report', ['only' => ['investReport','expenseReport',]]);
    // }

    public function projectReport(){
        $project_id = Session::get('project_id');
        if ($project_id !== null) {
            $data = [
                'projectReport' => Project::find($project_id),
                'purchases' => Purchase::select('vendor_id', 
                    DB::raw('SUM(total_amount) as total_amount'),
                    DB::raw('SUM(payable_amount) as total_payable_amount'),
                    DB::raw('SUM(paid) as total_paid'),
                    DB::raw('SUM(due) as total_due'))
                ->where('project_id', $project_id)
                ->groupBy('vendor_id')
                ->with('vendor') 
                ->paginate(15),

                'purchaseReport' => Purchase::where('project_id', $project_id)
                    ->select('date',
                    DB::raw('SUM(payable_amount) as total_payable_amount'),
                    DB::raw('SUM(paid) as total_paid'),
                    DB::raw('SUM(due) as total_due'))
                    ->groupBy('date')
                    ->orderBy('id', 'desc')
                    ->paginate(15),

                'expenses' => Expense::where('project_id', $project_id)
                    ->select('date',
                    DB::raw('SUM(total) as total_amount'))
                    ->groupBy('date')
                    ->orderBy('id', 'desc')
                    ->paginate(15),

                'flats' => Flat::where('project_id', $project_id)->where('sale_status',2)
                ->orderBy('id', 'desc')
                ->paginate(15),

                'project' => Project::find($project_id),
                'investments' => Investment::where('project_id', $project_id)
                ->orderBy('id', 'desc')
                ->paginate(10),
            ];

            // dd($data['flat']);
            //DB Query
            // $purchases = DB::table('purchases as p')
            // ->join('vendors as v', 'p.vendor_id', '=', 'v.id')
            // ->select('v.name', DB::raw('SUM(p.total_amount) as total_amount'))
            // ->where('p.project_id', $project_id)
            // ->groupBy('v.name')
            // ->get();

            return view('Project-Panel.Report.Project_report', $data);
        } else {
            return redirect()->route('list.project')->with('error', 'Project Id Is Null');
        }
    }

    public function investReport(Request $request)
    {
        $project_id = Session::get('project_id');
        if ($project_id !== null) {
            $client = Client::all();
            $installment = '';

            if ($request->name !== null || ($request->start_date !== null && $request->end_date !== null)) {
                if ($request->start_date == null && $request->end_date == null) {
                    $installment = InvestInstallment::whereHas('investment.client', function ($query) use ($request) {
                        $query->where('clients.id', $request->name);
                    })
                        ->orderBy('id', 'desc')
                        ->paginate(15);
                } elseif($request->name == null){
                    $installment = InvestInstallment::orderBy('id', 'desc')
                        ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })->paginate(15);
                }else {
                    $installment = InvestInstallment::orderBy('id', 'desc')
                        ->whereHas('investment.client', function ($query) use ($request) {
                            $query->where('clients.id', $request->name);
                        })->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                            $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                                $request->start_date,
                                $request->end_date,
                            ]);
                        })->paginate(15);
                }
            } else {
                $installment = InvestInstallment::orderBy('id', 'desc')->paginate(15);

                // foreach ($installment as $key => $value) {
                //     dd($value->investment->total_Investment);
                // }
               
            }

            return view('Project-Panel.Report.Invest_Report', compact('installment', 'client'));
        } else {
            return redirect()->route('list.project')->with('error', 'Project Id Is Null');
        }
    }

    public function expenseReport(Request $request){
        $project_id = Session::get('project_id');
        if ($project_id !== null) {

            $expense = "";
            if ($request->start_date !== null && $request->end_date !== null) {
                $expense = Expense::orderBy('id', 'desc')
                        ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(date)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })->paginate(15);
            }else{
                $expense = Expense::orderBy('id','desc')->paginate(15);
            }

            return view('Project-Panel.Report.Expense_Report', compact('expense'));
        } else {
            return redirect()->route('list.project')->with('error', 'Project Id Is Null');
        }
    }

    public function purchaseReport(Request $request){
        $project_id = Session::get('project_id');
        if ($project_id !== null) {
            $vendor = Vendor::all();
            $purchase = "";
            if ($request->name !== null || ($request->start_date !== null && $request->end_date !== null)) {
                if ($request->start_date == null && $request->end_date == null) {
                    $purchase = Purchase::where('vendor_id', $request->name)
                        ->orderBy('id', 'desc')
                        ->paginate(15);
                } elseif($request->name == null){
                    $purchase = Purchase::orderBy('id', 'desc')
                        ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })->paginate(15);
                }else {
                    $purchase = Purchase::orderBy('id', 'desc')
                        ->whereHas('purchase.vendor', function ($query) use ($request) {
                            $query->where('vendors.id', $request->name);
                        })->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                            $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                                $request->start_date,
                                $request->end_date,
                            ]);
                        })->paginate(15);
                }
            }else{
                $purchase = Purchase::orderBy('id','desc')->paginate(15);
            }

            return view('Project-Panel.Report.purchase_Report', compact('purchase','vendor'));
        } else {
            return redirect()->route('list.project')->with('error', 'Project Id Is Null');
        }
    }
}
