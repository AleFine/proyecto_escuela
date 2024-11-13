<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PadreFamiliaController extends Controller
{
    public function index()
    {
        return view('padre_familia.dashboard');
    }
}
