<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cpe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CpeController extends Controller
{
    // Método para listar todos os CPE
    public function list () {
        $cpe = Cpe::all();
        return response()->json($cpe);
    }

    // Método para criar um cpe novo
    public function newCpe(Request $request) {
        $validator = Validator::make($request->all(), [
            'serialnumber' => 'required|string|min:6|max:255',
            'equipament_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cpe = Cpe::create([
            'serialnumber' => $request->serialnumber,
            'equipament_id' => $request->equipament_id,
        ]);

        return response()->json([
            'message' => 'Cpe registrado com sucesso', 
            'cpe' => $cpe
        ]);
    }

    // Método para retornar um cpe específico pelo ID
    public function cpe($id)
    {
        $cpe = Cpe::find($id)->equipaments;

        if ($cpe) {
            return response()->json($cpe);
        } else {
            return response()->json(['message' => 'Cpe não encontrado'], 404);
        }
    }

    // Método para atualizar um cpe existente
    public function cpeEdit(Request $request, $id)
    {
        $cpe = Cpe::find($id);

        if ($cpe) {
            $validator = Validator::make($request->all(), [
                'serialnumber' => 'required|string|min:6|max:255',
                'equipament_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $cpe->update($request->all());
            return response()->json($cpe);
        } else {
            return response()->json(['message' => 'Cpe não encontrado'], 404);
        }
    }

    // Método para excluir um cpe
    public function cpeDelete($id)
    {
        $cpe = Cpe::find($id);

        if ($cpe) {
            $cpe->delete();
            return response()->json(['message' => 'Cpe deletado com sucesso']);
        } else {
            return response()->json(['message' => 'Cpe não encontrado'], 404);
        }
    }

}
