<?php

namespace App\Http\Controllers\Project\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use App\Models\Vendor;


class ProjectReturnPurchaseController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:list return purchase', ['only' => ['index','create','store','show']]);
    //    // $this->middleware('permission:create return purchase', ['only' => ['create','store']]);
    //    // $this->middleware('permission:show return purchase', ['only' => ['show']]);
    // }
    public function index(){
        $projectId = Session::get('project_id');
        if($projectId){
             $purchases = ReturnPurchase::where('project_id',$projectId)->orderBy('id','desc')->paginate(15);

             return view('Project-Panel.Purchase.Purchase_Return.Return_Purchase_List', compact('purchases' ));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function create(){
        if(Session::get('project_id')){
            $purchase = Purchase::orderBy('id','desc')->get();

            return view('Project-Panel.Purchase.Purchase_Return.Add_Return_Purchase', compact('purchase'));
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

            $purchase = Purchase::orderBy('id', 'desc')->first();
            $lastInvoice = ReturnPurchase::orderBy('id', 'desc')->first();
            $invoiceNumber = $lastInvoice ? ++$lastInvoice->invoice_no : 1;

            $purchasesData = [
                'project_id' => $projectId,
                'vendor_id' => $purchase->vendor_id,
                'memo_no' => $purchase->memo_no,
                'date' => $request->date,
                'purchase_id'=> $request->purchase_id,
                'invoice_no'=> $invoiceNumber + 10000,
                // ---------Use json_encode---------//
                'name' =>json_encode($names),
                'quantity' => json_encode($quantities),
                'unit' =>json_encode( $units),
                'price' => json_encode($prices),
                'total_price' => json_encode($total_prices),
                // ---------Use json_encode---------//

                'total' => $request->total,
                'paid' => $request->paid,
                'due' => $request->due,
                'created_by' => auth()->id(),

                //--------Use implode Method-------//
                // 'name' =>implode("**",$names),
                // 'quantity' => implode("**",$quantities),
                // 'unit' =>implode( "**",$units),
                // 'price' => implode("**",$prices),
                // 'total_price' => implode("**",$total_prices),
                //--------Use implode Method-------//
            ];
            $purchases = ReturnPurchase::create($purchasesData);
            return redirect()->route('project.return.purchase.list')-> with('success','Purchase Add Successful.');
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function show($id){
        $projectId = Session::get('project_id');
        if($projectId){
            $purchase = ReturnPurchase::where('project_id',$projectId)->where('id',$id)->first();

            return view('Project-Panel.Purchase.Purchase_Return.Return_Purchase_View', compact('purchase'));
        }else{
        return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
}
