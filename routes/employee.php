<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('employee', function () {
    return view('Employee-Panel.dashboard');
});
