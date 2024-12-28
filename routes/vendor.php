<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('vendors', function () {

    return view('Vendor-Panel.dashboard');
});
