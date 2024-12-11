<?php

namespace App\Http\Controllers\Controladores;

use App\Http\Controllers\Controller;
use App\Models\PadreFamilia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PadreController extends Controller
{
    public function index(){
        $padres = PadreFamilia::paginate(10);
        return view('cruds-roles.padres.index',compact('padres'));
    }

    public function create(){
        return view('cruds-roles.padres.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre'=>'required|max:100',
            'apellido'=>'required|max:100',
            'dni'=>'required|max:8|min:8',
            'telefono'=>'required|max:9|min:9',
        ],[
            'nombre'=>'Ingrese nombre, máximo 100 caracteres',
            'apellido'=>'Ingrese apellido, máximo 100 caracteres',
            'dni'=>'Ingrese dni, necesario 8 caracteres',
            'telefono'=>'Ingrese el teléfono, necesario 9 caracteres',
        ]);

        $id_padre_familia = DB::table('padres_familia')->insertGetId([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'dni' => $request->input('dni'),
            'telefono' => $request->input('telefono'),
            'created_at' => null,
            'updated_at' => null,
        ]);

        $contra_hash = Hash::make($request->input('dni'));

        DB::statement('CALL sp_insert_padre(?, ?, ?, ?, ?)', [
            $request->input('nombre'),
            $request->input('apellido'),
            $contra_hash,
            $request->input('dni'),
            $id_padre_familia,
        ]);

        return redirect()->route('padres.index')->with('success', 'Padre creado correctamente');
    }

    public function show($id){
        $padre = PadreFamilia::findOrFail($id);
        return view('cruds-roles.padres.edit', compact('padre'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre'=>'required|max:100',
            'apellido'=>'required|max:100',
            'telefono'=>'required|max:9|min:9',
        ],[
            'nombre'=>'Ingrese nombre, máximo 100 caracteres',
            'apellido'=>'Ingrese apellido, máximo 100 caracteres',
            'telefono'=>'Ingrese el teléfono, necesario 9 caracteres',
        ]);

        $padre = PadreFamilia::findOrFail($id);
        $padre->nombre = $request->nombre;
        $padre->apellido = $request->apellido;
        $padre->telefono = $request->telefono;
        $padre->save();
        return redirect()->route('padres.index')->with('success', 'Padre actualizado correctamente');
    }

    public function destroy($id){
        $padre = PadreFamilia::findOrFail($id);
        $user = User::where('id', $padre->id)->first();

        if($padre->hijos->count() > 0){
            return redirect()->route('padres.index')->with('success', 'No se puede eliminar a un padre con hijos');
        }
        else{
            $padre->delete();
            $user->delete();
            return redirect()->route('padres.index')->with('success', 'Padre eliminado correctamente');
        }
    }

    public function search(Request $request){
        $name_padre = $request->get('name_padre');
        $padres = PadreFamilia::where('nombre','like',$name_padre . '%')->paginate(10);
        return view('cruds-roles.padres.index',compact('padres'));
    }

    public function asignar($padre){
        $padre = PadreFamilia::findOrFail($padre);

        $estudiantes = Alumno::with('padres')->get()->filter(function ($estudiante) use ($padre) {
            if ($estudiante->padres->count() < 2) {
                return !$estudiante->padres->contains($padre);
            }
            return false;
        });

        return view('cruds-roles.padres.asignar', compact('padre', 'estudiantes'));
    }

    public function asignar_relacion(Request $request){
        $id_estudiante = $request->get('estudiante');
        $id_padre = $request->get('padre');

        DB::table('relacion_padres_alumnos')->insert([
            'id_padre_familia' => $id_padre,
            'id_alumno' => $id_estudiante,
            'created_at' => null,
            'updated_at' => null,
        ]);
        return redirect()->route('padres.asignar',['padre'=>$id_padre])->with('success', 'Registro Insertado Correctamente');
    }

    public function visualizar($padre){
        $padre = PadreFamilia::findOrFail($padre);
        return view('cruds-roles.padres.datos',compact('padre'));
    }

    public function eliminar_relacion($padre, $estudiante){
        DB::table('relacion_padres_alumnos')->where('id_padre_familia', $padre)->where('id_alumno', $estudiante)->delete();
        return redirect()->route('padres.asignar',['padre'=>$padre])->with('success', 'Registro Eliminado Correctamente');
    }

}
