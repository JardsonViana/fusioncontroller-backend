<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Equipament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EquipamentController extends Controller
{
   // Método para listar todos os Equipamentos
    public function list () {
        $equipament = Equipament::all();
        return response()->json($equipament);
    }

    // Método para criar um equipamento novo
    public function newEquipament(Request $request) {
        $validator = Validator::make($request->all(), [
            'hardware' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $equipament = Equipament::create([
            'hardware' => $request->hardware,
        ]);

        return response()->json([
            'message' => 'Equipamento registrado com sucesso', 
            'hardware' => $equipament
        ]);
    }

    // Método para retornar um equipamento específico pelo ID
    public function equipament($id)
    {
        $validaId = Equipament::find($id);
        if ($validaId) {
            $equipament = [];
            $equipament['equipament'] = Equipament::find($id)->only('id', 'hardware');
            $equipament['equipament']['cpe'] = Equipament::find($id)->cpe;

            return response()->json($equipament);
        } else {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }
        
    }
}
