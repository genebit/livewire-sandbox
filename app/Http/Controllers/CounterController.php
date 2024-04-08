<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        return view('pages.counter.index');
    }
}
