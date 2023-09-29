<?php

namespace App\Http\Controllers;

use App\Models\tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareasController extends Controller
{
    public function CrearTarea(Request $request){
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
        $nuevaTarea = new tareas();
        $nuevaTarea -> titulo = $request->input('titulo');
        $nuevaTarea -> contenido = $request->input('contenido');
        $nuevaTarea -> estado = $request->input('estado');
        $nuevaTarea -> autor = $request->input('autor');
        $nuevaTarea -> save();
            
        return $nuevaTarea;
    }

    private function Listar($id_tarea) {
        return tareas::all();
    }

    private function ListarUnaTarea($id_tarea) {
        return tareas::find($id_tarea);
    }
}
