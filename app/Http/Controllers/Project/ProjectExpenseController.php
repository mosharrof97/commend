<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Expense;
use App\Models\ExpenseCategory;

class ProjectExpenseController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:view expanse', ['only' => ['index']]);
    //     $this->middleware('permission:create expanse', ['only' => ['create','store']]);
    //     $this->middleware('permission:update expanse', ['only' => ['edit','update']]);
    //     $this->middleware('permission:show expanse', ['only' => ['show']]);
    // }
    public function index(){
        $projectId = Session::get('project_id');
        if($projectId){
             $expenses = Expense::where('project_id',$projectId)->paginate(15);;

             return view('Project-Panel.Expense.Expense_List', compact('expenses' ));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function create(){
        if(Session::get('project_id')){
            $category = ExpenseCategory::all();
            return view('Project-Panel.Expense.Add_Expense', compact('category'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }


    public function store(Request $request)
    {
        $projectId = Session::get('project_id');
         if($projectId){
            $request->validate([
                'date' => 'required',
            ]);

            $names = $request->input('name');
            $quantities = $request->input('quantity');
            $units = $request->input('unit');
            $prices = $request->input('price');
            $total_prices = $request->input('total_price');

            $expensesData = [
                'project_id' => $projectId,
                'date' => $request->date,
                // ---------Use json_encode---------//
                'name' =>json_encode($names),
                'quantity' => json_encode($quantities),
                'unit' =>json_encode( $units),
                'price' => json_encode($prices),
                'total_price' => json_encode($total_prices),
                // ---------Use json_encode---------//

                'total' => $request->total,
                'created_by' => auth()->id(),

                //--------Use implode Method-------//
                // 'name' =>implode("**",$names),
                // 'quantity' => implode("**",$quantities),
                // 'unit' =>implode( "**",$units),
                // 'price' => implode("**",$prices),
                // 'total_price' => implode("**",$total_prices),
                //--------Use implode Method-------//
            ];

            $expenses = Expense::create($expensesData);
            return redirect()->route('project.expense.list')-> with('success','Expense Add Successful.');
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function show($id){
        $projectId = Session::get('project_id');
        if($projectId){
            $expense = Expense::where('project_id',$projectId)->where('id',$id)->first();

            return view('Project-Panel.Expense.Expense_View', compact('expense'));
        }else{
        return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function edit($id){
        $projectId = Session::get('project_id');
        if($projectId){
            $expense = Expense::where('project_id',$projectId)->where('id',$id)->first();

            return view('Project-Panel.Expense.Edit_Expense', compact('expense'));
        }else{
        return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function update(Request $request, $id){
        $projectId = Session::get('project_id');
        if($projectId){
           $request->validate([
               'date' => 'required',
           ]);

           $names = $request->input('name');
           $quantities = $request->input('quantity');
           $units = $request->input('unit');
           $prices = $request->input('price');
           $total_prices = $request->input('total_price');

           $expensesData = [
               'project_id' => $projectId,
               'date' => $request->date,
               // ---------Use json_encode---------//
               'name' =>json_encode($names),
               'quantity' => json_encode($quantities),
               'unit' =>json_encode( $units),
               'price' => json_encode($prices),
               'total_price' => json_encode($total_prices),
               // ---------Use json_encode---------//

               'total' => $request->total,
               'created_by' => auth()->id(),

               //--------Use implode Method-------//
               // 'name' =>implode("**",$names),
               // 'quantity' => implode("**",$quantities),
               // 'unit' =>implode( "**",$units),
               // 'price' => implode("**",$prices),
               // 'total_price' => implode("**",$total_prices),
               //--------Use implode Method-------//
           ];
           $expenses = Expense::find($id);
           $expenses->update($expensesData);

           return redirect()->route('project.expense.list')-> with('success','Expense Add Successful.');
       }else{
           return redirect()->route('list.project')-> with('error','Project Id Is Null');
       }
    }
}
