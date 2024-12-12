<?php

namespace App\Http\Controllers\Controladores;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;
use App\Models\AreaAcademica;
use App\Models\DocenteAsignado;
use App\Models\Seccion;
use App\Models\Periodo;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfeController extends Controller
{
    public function index(){
        $profesores = Profesor::paginate(10);
        return view('cruds-roles.profesores.index',compact('profesores'));
    }

    public function create(){
        $areas = AreaAcademica::all();
        $niveles = Nivel::all();
        return view('cruds-roles.profesores.create',compact('areas','niveles'));
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
            'nivel' =>'required',
        ],[
            'nombre'=>'Ingrese nombre, máximo 100 caracteres',
            'apellido'=>'Ingrese apellido, máximo 100 caracteres',
            'dni'=>'Ingrese dni, necesario 8 caracteres',
            'telefono'=>'Ingrese el teléfono, necesario 9 caracteres',
            'direccion'=>'Ingrese la dirección',
            'area_academica' =>'Elegir una area académica',
            'fecha_ingreso'=>'Eliga la fecha',
            'fecha_nacimiento'=>'Eliga la fecha',
            'nivel' =>'Eliga un nivel',
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
            'id_nivel' => $request->input('nivel'),
            'created_at' => null,
            'updated_at' => null,
        ]);

        $contra_hash = Hash::make($request->input('dni'),);

        DB::statement('CALL sp_insert_profesor(?, ?, ?, ? , ?)', [
            $request->input('nombre'),
            $request->input('apellido'),
            $contra_hash,
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

    public function asignar_primaria($profesor){
        $profesor = Profesor::findOrFail($profesor);
        $docente_asignado = DocenteAsignado::where('id_profesor', $profesor->id_profesor)->first();
        $disabled = $docente_asignado ? true : false;
        $periodos = Periodo::all();
        return view('cruds-roles.profesores.asignar-primaria', compact('profesor', 'disabled','periodos'));
    }

    public function asignar_secundaria($profesor){
        $profesor = Profesor::findOrFail($profesor);
        $periodos = Periodo::all();
        return view('cruds-roles.profesores.asignar-secundaria', compact('profesor','periodos'));
    }


    public function asignar_seccion_primaria(Request $request){
        $id_profesor = $request->input('profesor');
        $id_grado = $request->input('grado');

        $id_docente_asignado = DB::table('docente_asignado')->insertGetId([
            'id_profesor' => $id_profesor,
            'id_seccion' => $request->input('seccion'),
            'id_periodo' => $request->input('periodo'),
            'created_at' => null,
            'updated_at' => null,
        ]);

        $cursos_insertar = Curso::where('id_grado', $id_grado)->get();
        foreach($cursos_insertar as $curso){
            DB::table('profesor_cursos')->insert([
                'id_docente_asignado' => $id_docente_asignado,
                'id_curso' => $curso->id_curso,
                'created_at' => null,
                'updated_at' => null,
            ]);
        }

        return redirect()->route('profes.asignar_primaria',['profesor'=>$id_profesor])->with('success', 'Docente asignado correctamente');
    }

    public function asignar_seccion_secundaria(Request $request){
        $id_profesor = $request->input('profesor');

        DB::table('docente_asignado')->insert([
            'id_profesor' => $id_profesor,
            'id_seccion' => $request->input('seccion'),
            'id_periodo' => $request->input('periodo'),
            'created_at' => null,
            'updated_at' => null,
        ]);

        return redirect()->route('profes.asignar_secundaria',['profesor'=>$id_profesor])->with('success', 'Docente asignado correctamente');
    }

    public function mostrar_cursos_primaria($profesor, $seccion){
        $cursos = DocenteAsignado::where('id_profesor', $profesor)
        ->where('id_seccion', $seccion)->first()->cursos;

        $profesor = Profesor::findOrFail($profesor);
        $seccion = Seccion::findOrFail($seccion);

        return view('cruds-roles.profesores.mostrar-cursos', compact('cursos','profesor','seccion'));
    }

    public function asignar_curso_secundaria($profesor, $seccion){

        $seccionE = Seccion::findOrFail($seccion);

        $cursos = Curso::where('id_grado', $seccionE->id_grado)
        ->whereDoesntHave('profesores', function ($query) use ($seccion) {
            $query->where('id_seccion', $seccion);
        })
        ->get();
        $docentesAsignados = DocenteAsignado::where('id_seccion', $seccion)
        ->where('id_profesor', $profesor)->get();

        $profesor = Profesor::findOrFail($profesor);

        return view('cruds-roles.profesores.asignar-curso-secundaria', compact('cursos','profesor','seccionE','docentesAsignados'));
    }

    public function registrar_curso_secundaria(Request $request){
        $id_profesor = $request->input('profesor');
        $id_seccion = $request->input('seccion');
        $docente_asignado = DocenteAsignado::where('id_profesor', $id_profesor)->where('id_seccion', $id_seccion)->first();
        DB::table('profesor_cursos')->insert([
            'id_docente_asignado' => $docente_asignado->id_docente_asignado,
            'id_curso' => $request->input('curso'),
            'created_at' => null,
            'updated_at' => null,
        ]);

        return redirect()->route('profes.asignar_curso_secundaria',['profesor'=>$id_profesor,'seccion'=>$id_seccion])->with('success', 'Curso añadido correctamente');
    }

    public function getGrados($nivelId){
        $grados = Grado::where('id_nivel',$nivelId)->get();
        return response()->json($grados);
    }

    public function getSecciones($gradoId){
        $secciones = Grado::findOrFail($gradoId)->secciones()
        ->whereNotIn('id_seccion', function($query) {
            $query->select('id_seccion')
                  ->from('docente_asignado');
        })
        ->get();

    return response()->json($secciones);
    }
}
