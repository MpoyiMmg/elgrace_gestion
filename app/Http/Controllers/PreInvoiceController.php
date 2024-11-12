<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use App\Models\PreInvoice;
use App\Models\PreInvoiceDetail;
use App\Models\Service;
use Illuminate\Http\Request;

class PreInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preInvoices = PreInvoice::whereHas('itemDetails', function ($query) { 
            $query->whereNull('article_id'); 
        })->get();

        return view('pages.invoice.service.index', [
            'preInvoices' => $preInvoices
        ]);
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
        $items = session('items');

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['quantity'] * $item['service']['price'];
        }

        $preInvoice = PreInvoice::create([
            'client_id' => $request->client_id,
            'reference' => $request->reference,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        // saving details
        foreach ($items as $item) {
            $preInvoice->itemDetails()->create([
                'service_id' => $item['service']['id'],
                'quantity' => $item['quantity'],
                'total_amount' => $item['quantity'] * $item['service']['price'],
            ]);
        }
        session(['items' => []]);
        return response()->json(['message' => "Invoice created successfully"]);
    }

    public function addServiceItem(Request $request)
    {
        $items = session('items', []);
        // Add item to session
        $newItem = $request->all();

        // check if there'is already item in session
        $itemExistsIndex = collect($items)->search(function ($item) use ($newItem) {
            return $item['service']['name'] === $newItem['service']['name'];
        });

        if ($itemExistsIndex !== false) {
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


    public function getItems()
    {
        return response()->json(['items' => session('items')]);
    }

    public function removeItem(Request $request)
    {
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
    public function show(Request $request)
    {
        $preInvoice = PreInvoice::find($request->invoice);

        return view('pages.invoice.service.details', [
            'preInvoice' => $preInvoice,
            'details' => $preInvoice->itemDetails()->where('article_id', null)->get(),
            'totalPrice' => $preInvoice->calculateTotalItemPrice()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // $items = session('items', []);
        $preInvoice = PreInvoice::find($request->invoice);
        $clients = Client::all();
        $services = Service::all();
        $items = $preInvoice->itemDetails->map(function ($item) {
            return [
                'service' => $item->service,
                'quantity' => $item->quantity,
                'total_amount' => $item->total_amount
            ];
        });

        session(['items' => $items]);
        return view('pages.invoice.service.edit', [
            'preInvoice' => $preInvoice,
            'clients' => $clients,
            'services' => $services,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $items = session('items');
        $preInvoice = PreInvoice::find($request->invoice);

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['quantity'] * $item['service']['price'];
        }

        $preInvoice->update([
            'client_id' => $request->client_id,
            'reference' => $request->reference,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        foreach ($items as $item) {
            $detail = PreInvoiceDetail::where('pre_invoice_id', $preInvoice->id)
                ->where('service_id', $item['service']['id'])
                ->first();
            if (is_null($detail)) {
                $preInvoice->itemDetails()->create([
                    'service_id' => $item['service']['id'],
                    'quantity' => $item['quantity'],
                    'total_amount' => $item['quantity'] * $item['service']['price'],
                ]);
            } else {
                $detail->update([
                    'quantity' => $item['quantity'],
                    'total_amount' => $item['quantity'] * $item['service']['price'],
                ]);
            }
        }

        return response()->json(['message' => "Invoice updated successfully"]);
    }

    public function listArticleInvoices()
    {
        $preInvoices = PreInvoice::all();
        return view('pages.invoice.article.index', [
            'preInvoices' => $preInvoices
        ]);
    }

    public function createArticleInvoice()
    {
        session(['articles' => []]);
        $clients = Client::all();
        $services = Service::all();
        $articles = Article::all();
        return view('pages.invoice.article.create', [
            'clients' => $clients,
            'services' => $services,
            'articles' => $articles
        ]);
    }

    public function addArticleItem(Request $request)
    {
        $items = session('articles', []);
        // Add item to session
        $newItem = $request->all();
        // check if there'is already item in session
        $itemExistsIndex = collect($items)->search(function ($item) use ($newItem) {
            return $item['article']['name'] === $newItem['article']['name'];
        });

        if ($itemExistsIndex !== false) {
            $items[$itemExistsIndex] = $newItem;
            $message = 'Élément modifié';
        } else {
            $items[] = $newItem;
            $message = 'Élément ajouté';
        }

        session(['articles' => $items]);
        // dd($itemExists);
        return response()->json(['message' => $message]);
    }

    public function removeArticleItem(Request $request)
    {
        $articles = session('articles', []);

        $index = $request->index;

        if (isset($articles[$index])) {
            unset($articles[$index]);
            session(['articles' => array_values($articles)]);
            return response()->json(['message' => 'Article deleted successfully']);
        }

        return response()->json(['message' => 'Article not found'], 404);
    }

    public function storeArticleInvoice(Request $request)
    {
        $items = session('articles');

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['quantity'] * $item['article']['unit_price'];
        }

        $preInvoice = PreInvoice::create([
            'client_id' => $request->client_id,
            'reference' => $request->reference,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        // saving details
        foreach ($items as $item) {
            $preInvoice->itemDetails()->create([
                'article_id' => $item['article']['id'],
                'service_id' => $item['service'],
                'quantity' => $item['quantity'],
                'total_amount' => $item['quantity'] * $item['article']['unit_price'],
            ]);
        }
        session(['articles' => []]);
        return response()->json(['message' => "Invoice created successfully"]);
    }

    public function showArticleInvoice(Request $request) {
        $preInvoice = PreInvoice::find($request->invoice);

        return view('pages.invoice.article.details', [
            'preInvoice' => $preInvoice,
            'details' => $preInvoice->itemDetails,
            'totalPrice' => $preInvoice->calculateTotalItemPrice()
        ]);
    }

    public function printArticleInvoice() {
        $preInvoice = PreInvoice::find(request()->invoice);
        $details = $preInvoice->itemDetails;
        $totalPrice = $preInvoice->calculateTotalItemPrice();
        $client = $preInvoice->client;

        return view('pages.invoice.article.print', [
            'preInvoice' => $preInvoice,
            'details' => $details,
            'totalPrice' => $totalPrice,
            'client' => $client
        ]);
    }

    public function editArticleInvoice(Request $request) {
        $preInvoice = PreInvoice::find($request->invoice);
        $clients = Client::all();
        $services = Service::all();
        $articles = Article::all();
        $items = $preInvoice->itemDetails->map(function ($item) {
            return [
                'service' => $item->service?->id,
                'article' => $item->article,
                'quantity' => $item->quantity,
                'total_amount' => $item->total_amount
            ];
        })->toArray();

        session(['articles' => $items]);
        return view('pages.invoice.article.edit', [
            'preInvoice' => $preInvoice,
            'clients' => $clients,
            'services' => $services,
            'articles' => $articles,
            'details' => $preInvoice->itemDetails
        ]);
    }

    public function updateArticleInvoice(Request $request) {
        $items = session('articles');
        $preInvoice = PreInvoice::find($request->invoice);

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['quantity'] * $item['article']['unit_price'];
        }

        $preInvoice->update([
            'client_id' => $request->client_id,
            'reference' => $request->reference,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        $preInvoice->itemDetails()->delete();

        foreach ($items as $item) { 
            $preInvoice->itemDetails()->create([
                'article_id' => $item['article']['id'],
                'service_id' => $item['service'],
                'quantity' => $item['quantity'],
                'total_amount' => $item['quantity'] * $item['article']['unit_price'],
            ]);
        }

        return response()->json(['message' => "Invoice updated successfully"]);
    }

    public function getArticleItems()
    {
        return response()->json(['articles' => session('articles')]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreInvoice $preInvoice)
    {
        //
    }
}
