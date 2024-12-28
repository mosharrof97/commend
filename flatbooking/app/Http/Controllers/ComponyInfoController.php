<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComponyInfo;
use App\Models\District;

class ComponyInfoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:compony info', ['only' => ['index','store']]);
    // }

    public function index(){
        $district = District::all();
        $componyInfo = ComponyInfo::first();
        return view('Admin-Panel.page.CompanyInfo.CompanyInfo', compact('district','componyInfo'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            // 'phone'=>'required',
            'address'=>'required',
        ]);

        $componyInfo = ComponyInfo::find($request->id);

        if($request->hasFile('logo')){
            $imageName = 'Company_logo_'.time().'-'.mt_rand(100000, 1000000000).'.'.$request->file('logo')->extension();
            $request->file('logo')->move(public_path('upload/CompanyInfo'),$imageName);

            if($componyInfo->logo){
                $oldImagePath = public_path('upload/CompanyInfo/'.$componyInfo->logo);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
        }

        if($request->hasFile('logo')){
            $componyInfo->update([
                'name'=>$request->name,
                // 'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'logo'=>$imageName,
            ]);
        }else{
            $componyInfo->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
            ]);
        }


        return redirect()->route('company.info.list');
    }


    public function showHeader()
    {
        $companyInfoLayout = CompanyInfo::first();
        return view('Admin-Panel.partial.Layout')->with('companyLayout', $companyLayout);
    }


}
