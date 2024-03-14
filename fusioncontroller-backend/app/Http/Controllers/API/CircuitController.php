<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Circuit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CircuitController extends Controller
{
    // Método para criar um cliente novo
    public function newCircuit(Request $request) {
        $validator = Validator::make($request->all(), [
            'protocol' => 'required|string|min:1|max:255',
            'userppp' => 'string|min:4|max:30|unique:circuits',
            'passppp' => 'string|min:6|max:30',
            'ipclient' => 'ipv4',
            'ipgateway' => 'ipv4',
            'netmask' => 'ipv4',
            'traffic' => 'integer',
            'expiration' => 'integer',
            'provider_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $circuit = Circuit::create([
            'protocol' => $request->protocol,
            'userppp' => $request->userppp,
            'passppp' => $request->passppp,
            'ipclient' => $request->ipclient,
            'ipgateway' => $request->ipgateway,
            'netmask' => $request->netmask,
            'traffic' => $request->traffic,
            'price' => $request->price,
            'expiration' => $request->expiration,
            'provider_id' => $request->provider_id,
        ]);

        return response()->json([
            'message' => 'Circuito registrado com sucesso', 
            'client' => $circuit
        ]);
    }

    // Método para retornar um cliente específico pelo ID
    public function circuit($id)
    {
        $circuit = Circuit::find($id);

        if ($circuit) {
            return response()->json($circuit);
        } else {
            return response()->json(['message' => 'Circuito não encontrado'], 404);
        }
    }

    // Método para atualizar um circuit existente
    public function circuitEdit(Request $request, $id)
    {
        $circuit = Circuit::find($id);

        if ($circuit) {
            $validator = Validator::make($request->all(), [
                'protocol' => 'required|string|min:6|max:255',
                'userppp' => 'required|string|min:4|max:30|unique:circuits',
                'passppp' => 'required|string|min:6|max:30',
                'ipclient' => 'string',
                'ipgateway' => 'string',
                'netmask' => 'string',
                'traffic' => 'integer',
                'price' => 'float',
                'expiration' => 'integer',
                'provider_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $circuit->update($request->all());
            return response()->json($circuit);
        } else {
            return response()->json(['message' => 'Circuito não encontrado'], 404);
        }
    }

    // Método para excluir um circuit
    public function circuitDelete($id)
    {
        $circuit = Circuit::find($id);

        if ($circuit) {
            $circuit->delete();
            return response()->json(['message' => 'Circuito deletado com sucesso']);
        } else {
            return response()->json(['message' => 'Circuito não encontrado'], 404);
        }
    }
}
