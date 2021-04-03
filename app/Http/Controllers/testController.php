<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    function tester()
    {
        $message = "OK";
        return view("pageTest")
                ->with('visiteur',session('visiteur'))
                ->with("message", $message);

    }
}
