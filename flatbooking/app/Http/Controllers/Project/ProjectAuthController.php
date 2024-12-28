<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;


class ProjectAuthController extends Controller
{

    public function index(Request $request){
        dd($request->id);
        // $request->session()->put('project_id',$request->id);

    }
    // public function create(){
    //     return view('Project-Panel\Auth\Login');
    // }

    // public function store(Request $request){

    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if(Auth::guard('project')->attempt($credentials)){
    //         $user = Project::where('email', $request->input('email'))->first();
    //         // No need to login again, as the attempt method already logged in the user
    //         return response()->json([
    //             'status' => true,
    //             'data' => $user,
    //             'success' => 'Login Successful',
    //         ]);
    //         // return redirect()->route('project.dashboard')->with('success','Login Successful');
    //     } else {
    //         // Handle unsuccessful login
    //         return response()->json([
    //             'status' => false,
    //             'error' => 'Login unsuccessful'
    //         ]);
    //         // return redirect()->route('project_login')->with('error','Login unsuccessful');
    //     }
    // }


    // public function logout(Request $request){

    //     Auth::guard('project')->logout();
    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();
    //     return redirect()->route('project_login')->with('Success','Logout successfully');
    // }

}
