<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Module;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\PreInvoice;
use Illuminate\Http\Request;
use App\Models\PreInvoiceDetail;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $modules = Module::all();
        if ($user->hasRole('cashier')) {
           $preInvoices = PreInvoice::all();
        } else {
            $preInvoices = PreInvoice::all()->filter(function ($item) {
                return $item->status !== 'draft';
            });
        }

        return view('pages.invoice.article.index', [
            'preInvoices' => $preInvoices,
            'modules' => $modules
        ]);
    }

    public function createArticleInvoice()
    {
        session(['articles' => []]);
        $clients = Client::all();
        $services = Service::all();
        $articles = Article::all();
        $modules = Module::all();
        return view('pages.invoice.article.create', [
            'clients' => $clients,
            'services' => $services,
            'articles' => $articles,
            'modules' => $modules,
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

    public function addModuleItem(Request $request)
    {
        $items = session('modules', []);
        // Add item to session
        $newItem = $request->all();
        // check if there'is already item in session
        $itemExistsIndex = collect($items)->search(function ($item) use ($newItem) {
            return $item['serviceDetails'] === $newItem['serviceDetails'];
        });

        if ($itemExistsIndex !== false) {
            $items[$itemExistsIndex] = $newItem;
            $message = 'Élément modifié';
        } else {
            $items[] = $newItem;
            $message = 'Élément ajouté';
        }

        session(['modules' => $items]);
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

    public function removeModuleItem(Request $request) {
        $modules = session('modules', []);

        $index = $request->index;

        if (isset($modules[$index])) {
            unset($modules[$index]);
            session(['modules' => array_values($modules)]);
            return response()->json(['message' => 'Module deleted successfully']);
        }

        return response()->json(['message' => 'Module not found'], 404);
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
            'module_id' => $request->module_id,
            'status' => 'draft',
            'total_amount' => $totalAmount,
        ]);

        $totalHt = 0;
        // saving details
        foreach ($items as $item) {
            $totalHt += $item['quantity'] * $item['article']['unit_price'];
            $preInvoice->itemDetails()->create([
                'article_id' => $item['article']['id'],
                'service_id' => $item['service'],
                'quantity' => $item['quantity'],
                'total_amount' => $item['quantity'] * $item['article']['unit_price'],
            ]);
        }

        $tva = $totalHt * 16 / 100; 
        $totalTTC = $totalHt + $tva;

        $preInvoice->update([
            'total_ht' => $totalHt,
            'total_ttc' => $totalTTC,
            'tva' => $tva,
        ]);

        session(['articles' => []]);
        return response()->json(['message' => "Invoice created successfully"]);
    }

    public function storeModuleInvoice(Request $request)
    {
        $items = session('modules');

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['price'];
        }

        $preInvoice = PreInvoice::create([
            'client_id' => $request->client_id,
            'reference' => $request->reference,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'module_id' => $request->items[0]['module']['id'],
            'status' => 'draft',
            'total_amount' => $totalAmount,
        ]);

        $totalHt = 0;
        // saving details
        foreach ($items as $item) {
            $totalHt += $item['price'];
            $preInvoice->itemDetails()->create([
                'module_invoice_details' => $item['serviceDetails'],
                'quantity' => 1,
                'total_amount' => $item['price'],
            ]);
        }
        $totalHt += $item['price'];

        $tva = $totalHt * 16 / 100; 
        $totalTTC = $totalHt + $tva;

        $preInvoice->update([
            'total_ht' => $totalHt,
            'total_ttc' => $totalTTC,
            'tva' => $tva,
        ]);

        session(['modules' => []]);
        return response()->json(['message' => "Invoice created successfully"]);
    }

    public function showArticleInvoice(Request $request) {
        $preInvoice = PreInvoice::find($request->invoice);
        $comments = $preInvoice->comments()->orderBy('created_at', 'DESC')->take(5)->get();
        return view('pages.invoice.article.details', [
            'preInvoice' => $preInvoice,
            'details' => $preInvoice->itemDetails,
            'totalPrice' => $preInvoice->calculateTotalItemPrice(),
            'comments' => $comments
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
        $modules =Module::all();
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
            'details' => $preInvoice->itemDetails,
            'modules' => $modules
        ]);
    }

    public function updateArticleInvoice(Request $request) {
        $items = session('articles');
        $preInvoice = PreInvoice::find($request->invoice);

        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['quantity'] * $item['article']['unit_price'];
        }

        $reduction = doubleval($request->reduction_rate);
        $reductionAmount = $preInvoice->total_ht * ($reduction / 100);

        $total_ht = $preInvoice->total_ht - $reductionAmount;
        $tva = $total_ht * 16 / 100;
        $totalTTC = $total_ht + $tva;

        $preInvoice->update([
            'client_id' => $request->client_id,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'draft',
            'total_amount' => $totalAmount,
            'total_ht' => $preInvoice->total_ht,
            'total_ttc' => $totalTTC,
            'tva' => $tva,
            'reduction_rate' => $reduction,
            'reduction_ht' => $reductionAmount,
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

    public function validateArticleInvoice(Request $request) {
        $user = Auth::user();
        $preInvoice = PreInvoice::find($request->invoice);
        $preInvoice->update([
            'status' => 'validated',
            'validated_at' => Carbon::now(),
            'validated_by' => $user->id
        ]);

        return response()->json(['message' => "Invoice validated successfully"], 200);
    }

    public function rejectArticleInvoice(Request $request) {
        $user = Auth::user();
        $preInvoice = PreInvoice::find($request->invoice);
        $preInvoice->update([
           'status' => 'rejected',
           'rejected_at' => Carbon::now(),
           'rejected_by' => $user->id
        ]);

        Comment::create([
            'pre_invoice_id' => $preInvoice->id,
            'content' => $request->comment
        ]);

        return response()->json(['message' => "Invoice rejected successfully"]);
    }

    public function sendForValidation(Request $request) {
        $preInvoice = PreInvoice::find($request->invoice);
        $preInvoice->update([
            'status' => 'pending'
        ]);

        return response()->json(['message' => "Invoice sent for validation successfully"]);
    }

    public function articleProformatToInvoice(Request $request) {
        $preInvoice = PreInvoice::find($request->invoice);

       
        if (!is_null($preInvoice->invoice)) {
            return response()->json(['error' => "Invoice already has an associated invoice"], 400);
        }
        Invoice::create([
            'reference' => $preInvoice->reference,
            'pre_invoice_id' => $preInvoice->id,
        ]);
        
        $preInvoice->update([
            'status' => 'accepted'
        ]);
        return response()->json(['message' => "Invoice created successfully"]);
    }

    public function getArticleItems() {
        return response()->json(['articles' => session('articles')]);
    }

    public function getModuleItems() {
        return response()->json(['modules' => session('modules')]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreInvoice $preInvoice)
    {
        //
    }
}
