<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Actions\CreateServiceAction;
use App\Actions\UpdateServiceAction;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services  = Service::all();
        return view('pages.service.index', [
            'services' => $services
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
    public function store(Request $request, CreateServiceAction $createServiceAction)
    {
        try {
            $service = $createServiceAction->execute($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['message' => "Service créé avec succès!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('pages.service.edit', compact('service'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service, UpdateServiceAction $updateServiceAction)
    {
        try {
            $updateServiceAction->execute($service, $request->all());
    
            return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
{
    try {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    } catch (\Exception $e) {
        return redirect()->route('services.index')->with('error', 'Une erreur est survenue lors de la suppression.');
    }
}

}
