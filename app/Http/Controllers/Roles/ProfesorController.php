<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index($gmail)
    {
        $id_profesor = User::where("email",$gmail)->first()->id;
        $profesor = Profesor::where("user_id",$id_profesor)->first();

    }

    public function show(int $curso){

    }
}
