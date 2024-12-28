<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Models\Admin;
use App\Models\Project;
use App\Models\Flat;
use App\Models\Payment;
use App\Models\Client;
use App\Models\Purchase;
use App\Models\PurchaseDuePay;


class AdminController extends Controller
{
    public function dashboard(){
        // dd(auth()->user());
        $data = [
            'projects' => Project::get(),
            'flats'=> Flat::get(),
            'soldFlat'=> Flat::where('sale_status',2)->get(),
            'unSoldFlat'=> Flat::where('sale_status',0)->get(),
            'payment'=> Payment::get(),   
            'client'=> Client::get(), 
            'purchase'=> Purchase:: get(),    
            'purchasePay' => PurchaseDuePay::get(),    
        ];
       //return$data['purchasePay'];

        return view('Admin-Panel.dashboard', $data);
    }


    // public function login(){
    //     return view('AdminLogin');
    // }

    // public function login_submit(Request $request){

    //     $request ->validate([
    //             'email' =>'required|email',
    //             'password'=>'required',

    //     ]);

    //     $credentials = $request ->only('email','password');

    //     if(Auth::guard('admin')->attempt($credentials)){

    //         $user = Admin::where('email',$request->input('email'))->first();
    //         Auth::guard('admin')->login($user);
    //         return redirect()->route('admin_dashboard')->with('success','Login Successful');
    //     }else{
    //         return redirect()->route('admin_login')->with('error','Login unsuccessful');
    //     }
    // }

    // public function logout(){

    //     Auth::guard('admin')->logout();
    //     return redirect()->route('admin_login')->with('Success','Logout successfully');
    // }


    public function createAdmin(Request $request){
        return view('AdminRegister');
    }

    public function storeAdmin(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $newuser = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($newuser));

        $user = Admin::where('email',$request->input('email'))->first();
        Auth::guard('admin')->login($user);
        return redirect()->route('admin_dashboard')->with('success','Login Successful');

    }
}
