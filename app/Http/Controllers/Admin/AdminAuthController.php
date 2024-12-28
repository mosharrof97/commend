<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthController extends Controller
{

    public function login(){
        return view('Admin-Panel.Auth.Login');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email' => 'The provided credentials do not match our records.',
        ]);

        // dd($request->all());
        // if (Auth::attempt($credentials)){};
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,])) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error','The provided credentials do not match our records.');
    }



    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

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



        // $url = '';
        // if ($request->user()->role == 'admin') {
        //     $url=view('dashboard');
        // }
        // elseif($request->user()->role == 'user' ){
        //     $url = view('userDashboard');
        // }
        // else{
        //     $url = '/login';
        // }
        // return redirect()->intended($url );
}
