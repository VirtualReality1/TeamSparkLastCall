<?php

namespace App\Http\Controllers;

class StaticController extends Controller
{
    public function index()
    {
        return view('static.index');
    }

    public function tos()
    {
        return view('static.tos');
    }

    public function imprint()
    {
        return view('static.imprint');
    }

    public function privacy()
    {
        return view('static.privacy');
    }
}
