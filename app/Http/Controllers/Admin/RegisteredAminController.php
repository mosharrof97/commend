<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredAminController extends Controller
{
    public function create(): View
    {
        return view('Admin-Panel.Auth.Registered');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone'=>['required','unique:'.Admin::class],
            'nid'=>['required','unique:'.Admin::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image'=>['required'],
        ]);

        if($request->hasFile('image')){
            $imageName = 'Admin_'.time().'_'.mt_rand(1000000,1000000000).'.'.$request->File('image')->extension();
            $request->File('image')->move(public_path('upload/Project'), $imageName);
        }
        // dd($request->all());
        $user = Admin::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'nid' => $request->nid,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id'=> 1,
            'image' => $imageName ?? 'No Image',
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('admin.login');
    }
}
