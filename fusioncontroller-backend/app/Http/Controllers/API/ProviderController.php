<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    // Método para criar um provider novo
    public function newProvider(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6|max:255',
            'cnpj' => 'required|string|min:6|max:255|unique:providers',
            'phone' => 'string',
            'client_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $provider = Provider::create([
            'name' => $request->name,
            'cnpj' => $request->cnpj,
            'phone' => $request->phone,
            'client_id' => $request->client_id,
        ]);

        return response()->json([
            'message' => 'Provider registrado com sucesso', 
            'provider' => $provider
        ]);
    }

    // Método para retornar um provider específico pelo ID
    public function provider($id)
    {
        $provider = Provider::find($id);

        if ($provider) {
            return response()->json($provider);
        } else {
            return response()->json(['message' => 'Provider não encontrado'], 404);
        }
    }

    // Método para atualizar um provider existente
    public function providerEdit(Request $request, $id)
    {
        $provider = Provider::find($id);

        if ($provider) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:6|max:255',
                'cnpj' => 'required|string|min:6|max:255',
                'phone' => 'string',
                'client_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $provider->update($request->all());
            return response()->json($provider);
        } else {
            return response()->json(['message' => 'Provider não encontrado'], 404);
        }
    }

    // Método para excluir um provider
    public function providerDelete($id)
    {
        $provider = Provider::find($id);

        if ($provider) {
            $provider->delete();
            return response()->json(['message' => 'Provider deletado com sucesso']);
        } else {
            return response()->json(['message' => 'Provider não encontrado'], 404);
        }
    }
}
