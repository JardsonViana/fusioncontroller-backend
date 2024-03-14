<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Provider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    // Método para listar todos os clientes
    public function list () {
        $clients = Client::all();
        return response()->json($clients);
    }


    // Método para criar um cliente novo
    public function newClient(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6|max:255',
            'userweb' => 'required|string|min:4|max:30|unique:clients',
            'passweb' => 'required|string|min:6|max:30',
            'state' => 'string',
            'city' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $randomUservpn = Str::random(12);
        $randomPassvpn = Str::random(12);


        $client = Client::create([
            'name' => $request->name,
            'userweb' => $request->userweb,
            'passweb' => Hash::make($request->passweb),
            'state' => $request->state,
            'city' => $request->city,
            'uservpn' => $randomUservpn,
            'passvpn' => Hash::make($randomPassvpn)
        ]);

        return response()->json([
            'message' => 'Cliente registrado com sucesso', 
            'client' => $client
        ]);
    }

    // Método para retornar um cliente específico pelo ID
    public function client($id)
    {
        $validaId = Client::find($id);

        if ($validaId) {
            $client = [];
            //$client['Cliente'] = Client::find($id);
            //$client['Cliente']['Provider'] = Client::find($id)->provider;
            $client['Cliente'] = Client::with('provider.circuit')->find($id);
            $client['Cliente']['Cpe'] = Client::find($id)->cpe;
            
            return response()->json($client);
        } else {
            return response()->json(['message' => 'Client não encontrado'], 404);
        }
    }

    // Método para atualizar um cliente existente
    public function clientEdit(Request $request, $id)
    {
        $client = Client::find($id);

        if ($client) {
            $validator = Validator::make($request->all(), [
                'name' => 'string|min:6|max:255',
                'userweb' => 'string|min:4|max:30',
                'passweb' => 'string|min:6|max:30',
                'state' => 'string',
                'city' => 'string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $client->update($request->all());
            return response()->json($client);
        } else {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
    }

    // Método para excluir um cliente
    public function clientDelete($id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->delete();
            return response()->json(['message' => 'Cliente deletado com sucesso']);
        } else {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
    }
}
