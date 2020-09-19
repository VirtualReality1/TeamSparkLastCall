<?php

namespace App\Http\Controllers;

class CookieController extends Controller
{
    public function accept()
    {
        session(['cookies' => true]);
        return redirect()->back();
    }

    public function decline()
    {
        session(['cookies' => false]);
        return redirect()->back();
    }
}
