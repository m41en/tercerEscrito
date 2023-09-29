<?php

namespace App\Http\Controllers;

use App\Models\tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareasController extends Controller
{
    public function CrearTarea(Request $request) {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required | string',
            'contenido' => 'required | string',
            'estado' => 'nullable | string',
            'autor' => 'nullable | string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        return $this->GuardarTarea($request);
    }

    private function GuardarTarea(Request $request) {
        try {
            DB::raw('LOCK TABLE tareas WRITE');
            DB::beginTransaction();
    
            $nuevaTarea = new tareas();
            $nuevaTarea -> titulo = $request->post('titulo');
            $nuevaTarea -> contenido = $request->post('contenido');
            $nuevaTarea -> estado = $request->post('estado');
            $nuevaTarea -> autor = $request->post('autor');
            $nuevaTarea->save();
    
            return response()->json([$nuevaTarea], 201);
            DB::commit();
            DB::raw('UNLOCK TABLES');
        } catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        } catch (\PDOException $th) {
            return response("Permiso a la BD denegado",403);
        }
    }

    public function EditarTarea(Request $request) {
        $validator = Validator::make($request->all(),[
            'titulo' => 'required | string',
            'contenido' => 'required | string',
            'estado' => 'nullable | string',
            'autor' => 'nullable | string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this -> Editar($request);
    }

    public function Editar(request $request) {
        try {
            DB::raw('LOCK TABLE tareas WRITE');
            DB::beginTransaction();

            $tarea = tareas::findOrFail($request->post("id"));
            $tarea -> titulo = $request->post('titulo');
            $tarea -> contenido = $request->post('contenido');
            $tarea -> estado = $request->post('estado');
            $tarea -> autor = $request->post('autor');
            $tarea->save();

            return response()->json([$tarea], 201);
        } catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        } catch (\PDOException $th) {
            return response("Permiso a la BD denegado",403);
        }
    }

    private function Listar($id_tarea) {
        return tareas::all();
    }

    private function ListarUnaTarea($id_tarea) {
        return tareas::find($id_tarea);
    }
}
