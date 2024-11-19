<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PAdreFamilia;

use Illuminate\Http\Request;

class PadreFamiliaController extends Controller
{
    public function index($gmail)
    {
        $id_padre = User::where("email",$gmail)->first()->id;
        $padre = PadreFamilia::where("id",$id_padre)->first();
        $hijos = $padre->hijos;
        return view('padre_familia.dashboard',compact('padre','hijos'));
    }

    public function show($id)
    {

    }
}
