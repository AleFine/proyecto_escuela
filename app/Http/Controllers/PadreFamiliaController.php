<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PadreFamiliaController extends Controller
{
    public function index()
    {
        return view('padre_familia.dashboard');
    }
}
