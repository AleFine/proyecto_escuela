<?php

namespace App\Http\Controllers\Controladores;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;
use App\Models\AreaAcademica;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfeController extends Controller
{
    public function index(){
        $profesores = Profesor::paginate(10);
        return view('cruds-roles.profesores.index',compact('profesores'));
    }

    public function create(){
        $areas = AreaAcademica::all();
        return view('cruds-roles.profesores.create',compact('areas'));
    }

    public function store(Request $request){
        $request->validate([
            'nombre'=>'required|max:100',
            'apellido'=>'required|max:100',
            'dni'=>'required|max:8|min:8',
            'telefono'=>'required|max:9|min:9',
            'direccion'=>'required|max:100',
            'area_academica' =>'required',
            'fecha_ingreso'=>'required|date',
            'fecha_nacimiento'=>'required|date',
        ],[
            'nombre'=>'Ingrese nombre, máximo 100 caracteres',
            'apellido'=>'Ingrese apellido, máximo 100 caracteres',
            'dni'=>'Ingrese dni, necesario 8 caracteres',
            'telefono'=>'Ingrese el teléfono, necesario 9 caracteres',
            'direccion'=>'Ingrese la dirección',
            'area_academica' =>'Elegir una area académica',
            'fecha_ingreso'=>'Eliga la fecha',
            'fecha_nacimiento'=>'Eliga la fecha',
        ]);

        $id_profesor = DB::table('profesores')->insertGetId([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'dni' => $request->input('dni'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'fecha_ingreso' => $request->input('fecha_ingreso'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'id_area_academica' => $request->input('area_academica'),
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::statement('CALL sp_insert_profesor(?, ?, ?, ?)', [
            $request->input('nombre'),
            $request->input('apellido'),
            $request->input('dni'),
            $id_profesor,
        ]);

        return redirect()->route('profes.index')->with('success', 'Docente creado correctamente');
    }

    public function show($id){
        $profesor = Profesor::findOrFail($id);
        $areas = AreaAcademica::all();
        return view('cruds-roles.profesores.edit', compact('profesor','areas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre'=>'required|max:100',
            'apellido'=>'required|max:100',
            'telefono'=>'required|max:9|min:9',
            'direccion'=>'required|max:100',
            'area_academica' =>'required',
            'fecha_ingreso'=>'required|date',
            'fecha_nacimiento'=>'required|date',
        ],[
            'nombre'=>'Ingrese nombre, máximo 100 caracteres',
            'apellido'=>'Ingrese apellido, máximo 100 caracteres',
            'telefono'=>'Ingrese el teléfono, necesario 9 caracteres',
            'direccion'=>'Ingrese la dirección',
            'area_academica' =>'Elegir una area académica',
            'fecha_ingreso'=>'Eliga la fecha',
            'fecha_nacimiento'=>'Eliga la fecha',
        ]);

        $padre = Profesor::findOrFail($id);
        $padre->nombre = $request->nombre;
        $padre->apellido = $request->apellido;
        $padre->telefono = $request->telefono;
        $padre->direccion = $request->direccion;
        $padre->id_area_academica = $request->area_academica;
        $padre->fecha_ingreso = $request->fecha_ingreso;
        $padre->fecha_nacimiento = $request->fecha_nacimiento;
        $padre->save();
        return redirect()->route('profes.index')->with('success', 'Docente actualizado correctamente');
    }

    public function destroy($id){
        $profesor = Profesor::findOrFail($id);
        $user = User::where('id', $profesor->user_id)->first();

        if($profesor->docente_asignado->count() > 0){
            return redirect()->route('profes.index')->with('success', 'El profesor aun tiene secciones, no es posible eliminar');
        }
        else{
            $profesor->delete();
            $user->delete();
            return redirect()->route('profes.index')->with('success', 'Docente eliminado correctamente');
        }
    }

    public function search(Request $request){
        $name_profesor = $request->get('name_profesor');
        $profesores = Profesor::where('nombre','like',$name_profesor . '%')->paginate(10);
        return view('cruds-roles.profesores.index',compact('profesores'));
    }

    public function visualizar($padre){
        $profesor = Profesor::findOrFail($padre);
        return view('cruds-roles.profesores.datos',compact('profesor'));
    }
}
