<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Actions\CreateClientAction;
use App\Actions\UpdateClientAction;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view("pages.client.index", [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateClientAction $createClientAction)
    {
        try {
            $createClientAction->execute($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['message' => "Client créé avec succès!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Client $client)
        {
         return view('pages.client.edit', compact('client'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client, UpdateClientAction $updateClientAction)
{
  
    $updateClientAction->execute($client, $request->all());

    return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('clients.index')->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
    
}
