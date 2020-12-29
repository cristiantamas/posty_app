<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){

        //logout the user
        auth()->logout();

        // redirect to home
        return redirect()->route('home');


    }
}
