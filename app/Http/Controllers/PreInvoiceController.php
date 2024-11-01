<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PreInvoice;
use App\Models\Service;
use Illuminate\Http\Request;

class PreInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.invoice.service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session(['items' => []]);
        $clients = Client::all();
        $services = Service::all();
        return view('pages.invoice.service.create', [
            'clients' => $clients,
            'services' => $services
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session('info', 'Storage info there');

        return response()->json(['info' => 'cool']);
    }

    public function addItem(Request $request) {
        $items = session('items', []);
        // Add item to session
        $newItem = $request->all();

        // check if there'is already item in session
        $itemExistsIndex = collect($items)->search(function ($item) use ($newItem){
            return $item['service']['name'] === $newItem['service']['name'];
        });

        if($itemExistsIndex !== false) {
            $items[$itemExistsIndex] = $newItem;
            $message = 'Élément modifié';
        } else {
            $items[] = $newItem;
            $message = 'Élément ajouté';
        }

        session(['items' => $items]);
        // dd($itemExists);
        return response()->json(['message' => $message]);
    }


    public function getItems() {
        return response()->json(['items' => session('items')]);
    }

    public function removeItem(Request $request) {
        $items = session('items', []);

        $index = $request->index;

        if (isset($items[$index])) {
            unset($items[$index]);
            session(['items' => array_values($items)]);
            return response()->json(['message' => 'Item deleted successfully']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
    /**
     * Display the specified resource.
     */
    public function show(PreInvoice $preInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreInvoice $preInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreInvoice $preInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreInvoice $preInvoice)
    {
        //
    }
}
