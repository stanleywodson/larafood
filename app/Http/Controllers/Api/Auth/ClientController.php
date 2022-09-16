<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
           'email'       => 'required|email',
           'password'    => 'required',
           'device_name' => 'required'
        ]);

        if (!$client = \App\Models\Client::where('email', $request->email)->first())
            return response()->json(['message' => 'Client not found'], 404);

        if (!$client || !\Hash::check($request->password, $client->password))
            return response()->json(['massage'=> 'Credentais invalid'], 404);

        $token = $client->createToken($request->device_name)->plainTextToken;

        return response()->json(['token'=> $token]);

    }

    public function me(Request $request)
    {
        $client = $request->user();

        return new ClientResource($client);
    }
}
