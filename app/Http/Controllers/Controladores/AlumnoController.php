<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Region;
use App\Models\Ciudad;
use App\Models\Distrito;

class AlumnoController extends Controller
{
    const PAGINATION = 10;

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $alumnos = Alumno::where('nombre', 'like', $buscarpor . '%')
            ->paginate(self::PAGINATION);

        return view('alumnos.index', compact('alumnos', 'buscarpor'));
    }

    public function create()
    {
        $regiones = Region::all();
        return view('alumnos.create', compact('regiones'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate(
                [
                    'nombre' => 'required|max:50',
                    'apellido' => 'required|max:50',
                    'dni' => 'required|size:8|unique:alumnos,dni',
                    'fecha_nacimiento' => 'required|date',
                    'genero' => 'required|max:10',
                    'region' => 'required|max:50',
                    'ciudad' => 'required|max:50',
                    'distrito' => 'required|max:50',
                    'telefono' => 'required|max:15',
                    'imagen_rostro' => 'nullable|image|max:2048',
                ],
                [
                    'nombre.required' => 'Ingrese el nombre del alumno',
                    'apellido.required' => 'Ingrese el apellido del alumno',
                    'dni.required' => 'Ingrese el DNI',
                    'dni.unique' => 'El DNI ingresado ya está registrado',
                    'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento',
                    'genero.required' => 'Ingrese el género',
                    'region.required' => 'Ingrese la región',
                    'ciudad.required' => 'Ingrese la ciudad',
                    'distrito.required' => 'Ingrese el distrito',
                    'telefono.required' => 'Ingrese el teléfono',
                    'imagen_rostro.image' => 'La imagen debe ser de un formato válido',
                    'imagen_rostro.max' => 'La imagen debe tener un tamaño máximo de 2 MB',
                ]
            );

            $region = Region::findOrFail($data['region']);
            $ciudad = Ciudad::findOrFail($data['ciudad']);
            $distrito = Distrito::findOrFail($data['distrito']);

            $data['region'] = $region->nombre;
            $data['ciudad'] = $ciudad->nombre;
            $data['distrito'] = $distrito->nombre;

            if ($request->hasFile('imagen_rostro')) {
                $file = $request->file('imagen_rostro');
                
                if (!$file->isValid()) {
                    throw new \Exception('El archivo de imagen no es válido');
                }
    
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'alumnos/' . $fileName;
    
                $fileContent = file_get_contents($file->getRealPath());
    
                $storage = new \Google\Cloud\Storage\StorageClient([
                    'projectId' => config('filesystems.disks.gcs.project_id'),
                    'keyFilePath' => config('filesystems.disks.gcs.key_file'),
                ]);
    
                $bucket = $storage->bucket(config('filesystems.disks.gcs.bucket'));
                
                $object = $bucket->upload($fileContent, [
                    'name' => $filePath,
                ]);
    
                $data['imagen_rostro'] = 'https://storage.googleapis.com/' . config('filesystems.disks.gcs.bucket') . '/' . $filePath;
    
                Log::info('Imagen subida exitosamente', [
                    'path' => $filePath,
                    'url' => $data['imagen_rostro']
                ]);
            }
    
            Alumno::create($data);
            
            return redirect()
                ->route('alumnos.index')
                ->with('datos', 'Registro Nuevo Guardado...!');
    
        } catch (\Exception $e) {
            Log::error('Error al crear alumno:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
    
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['imagen_rostro' => 'Error al procesar la imagen: ' . $e->getMessage()]);
        }
    
    
    }

    public function edit($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            $regiones = Region::all();
            return view('alumnos.edit', compact('alumno', 'regiones'));
        } catch (\Exception $e) {
            Log::error('Error al cargar edición:', [
                'error' => $e->getMessage(),
                'alumno_id' => $id
            ]);
            return redirect()->route('alumnos.index')
                ->withErrors(['error' => 'No se pudo cargar el alumno para editar']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate(
                [
                    'nombre' => 'required|max:50',
                    'apellido' => 'required|max:50',
                    'dni' => 'required|size:8|unique:alumnos,dni,' . $id . ',id_alumno',
                    'fecha_nacimiento' => 'required|date',
                    'genero' => 'required|max:10',
                    'region' => 'required|max:50',
                    'ciudad' => 'required|max:50',
                    'distrito' => 'required|max:50',
                    'telefono' => 'required|max:15|regex:/^9\d{8}$/',
                    'imagen_rostro' => 'nullable|image|max:2048', 
                ],
                [
                    'nombre.required' => 'Ingrese el nombre del alumno',
                    'apellido.required' => 'Ingrese el apellido del alumno',
                    'dni.required' => 'Ingrese el DNI',
                    'dni.unique' => 'El DNI ingresado ya está registrado',
                    'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento',
                    'genero.required' => 'Ingrese el género',
                    'region.required' => 'Ingrese la región',
                    'ciudad.required' => 'Ingrese la ciudad',
                    'distrito.required' => 'Ingrese el distrito',
                    'telefono.required' => 'Ingrese el teléfono',
                    'imagen_rostro.image' => 'La imagen debe ser de un formato válido',
                    'imagen_rostro.max' => 'La imagen debe tener un tamaño máximo de 2 MB',
                ]
            );

            $region = Region::findOrFail($data['region']);
            $ciudad = Ciudad::findOrFail($data['ciudad']);
            $distrito = Distrito::findOrFail($data['distrito']);

            $data['region'] = $region->nombre;
            $data['ciudad'] = $ciudad->nombre;
            $data['distrito'] = $distrito->nombre;
            $alumno = Alumno::findOrFail($id);

            if ($request->has('remove_image') && $request->remove_image == 1) {
                if ($alumno->imagen_rostro) {
                    if (!$this->deleteImageFromStorage($alumno->imagen_rostro)) {
                        throw new \Exception('No se pudo eliminar la imagen actual');
                    }
                    $data['imagen_rostro'] = null;
                }
            }
            elseif ($request->hasFile('imagen_rostro')) {
                $file = $request->file('imagen_rostro');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'alumnos/' . $fileName;
                
                if ($alumno->imagen_rostro) {
                    $this->deleteImageFromStorage($alumno->imagen_rostro);
                }
    
                $storage = new \Google\Cloud\Storage\StorageClient([
                    'projectId' => config('filesystems.disks.gcs.project_id'),
                    'keyFilePath' => config('filesystems.disks.gcs.key_file'),
                ]);
    
                $bucket = $storage->bucket(config('filesystems.disks.gcs.bucket'));
                $bucket->upload(
                    file_get_contents($file->getRealPath()),
                    ['name' => $filePath]
                );
    
                $data['imagen_rostro'] = 'https://storage.googleapis.com/' . config('filesystems.disks.gcs.bucket') . '/' . $filePath;
            }

            $alumno->update($data);
            return redirect()->route('alumnos.index')->with('datos', 'Registro Actualizado...!');
        
        } catch (\Exception $e) {
            Log::error('Error en actualización:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    public function confirmar($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            return view('alumnos.confirmar', compact('alumno'));
        } catch (\Exception $e) {
            Log::error('Error al cargar confirmación:', [
                'error' => $e->getMessage(),
                'alumno_id' => $id
            ]);
            return redirect()->route('alumnos.index')
                ->withErrors(['error' => 'No se pudo cargar la confirmación de eliminación']);
        }
    }

    public function destroy($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            
            if ($alumno->imagen_rostro) {
                if (!$this->deleteImageFromStorage($alumno->imagen_rostro)) {
                    Log::warning('No se pudo eliminar la imagen al borrar el alumno', [
                        'alumno_id' => $id,
                        'imagen_url' => $alumno->imagen_rostro
                    ]);
                }
            }
    
            $alumno->delete();
            return redirect()
                ->route('alumnos.index')
                ->with('datos', 'Registro Eliminado...!');
        } catch (\Exception $e) {
            Log::error('Error al eliminar alumno:', [
                'error' => $e->getMessage(),
                'alumno_id' => $id
            ]);
            
            return redirect()
                ->back()
                ->withErrors(['error' => 'Error al eliminar el registro: ' . $e->getMessage()]);
        }
    }

    private function deleteImageFromStorage($imageUrl)
    {
        try {
            if (!$imageUrl) return true;

            $storage = new \Google\Cloud\Storage\StorageClient([
                'projectId' => config('filesystems.disks.gcs.project_id'),
                'keyFilePath' => config('filesystems.disks.gcs.key_file'),
            ]);

            $bucket = $storage->bucket(config('filesystems.disks.gcs.bucket'));
            $filePath = str_replace('https://storage.googleapis.com/' . config('filesystems.disks.gcs.bucket') . '/', '', $imageUrl);
            
            if ($bucket->object($filePath)->exists()) {
                $bucket->object($filePath)->delete();
                Log::info('Imagen eliminada exitosamente', ['path' => $filePath]);
                return true;
            }
            
            return true; 
        } catch (\Exception $e) {
            Log::error('Error al eliminar imagen:', [
                'error' => $e->getMessage(),
                'url' => $imageUrl
            ]);
            return false;
        }
    }

    public function show($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            return view('alumnos.show', compact('alumno'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar alumno:', [
                'error' => $e->getMessage(),
                'alumno_id' => $id
            ]);
            return redirect()->route('alumnos.index')
                ->withErrors(['error' => 'No se pudo encontrar el alumno solicitado']);
        }
    }

    public function getCiudades(Request $request)
    {
        $ciudades = Ciudad::where('region_id', $request->region_id)->get();
        return response()->json($ciudades);
    }

    public function getDistritos(Request $request)
    {
        $distritos = Distrito::where('ciudad_id', $request->ciudad_id)->get();
        return response()->json($distritos);
    }

}
