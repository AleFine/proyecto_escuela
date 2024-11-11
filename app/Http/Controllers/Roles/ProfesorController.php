<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        return view('profesor.dashboard');
    }
}
