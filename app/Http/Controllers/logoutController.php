<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logoutController extends Controller
{
    public  function  logout()
    {
        session()->forget('token');
        return redirect()->route('main.index');
    }
}
