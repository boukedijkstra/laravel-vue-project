<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function boats()
    {
        return view('boats');
    }

    public function jobs()
    {
        return view('jobs');
    }

    public function periodics()
    {
        return view('periodics');
    }
}
