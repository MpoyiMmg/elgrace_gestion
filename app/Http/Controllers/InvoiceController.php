<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::all();
        return view('pages.invoice.final.index', [
            'invoices' => $invoices
        ]);
    }

    public function details() {
        $invoice = Invoice::find(request('invoice'));
        return view('pages.invoice.final.details', [
            'invoice' => $invoice,
            'details' => $invoice->preInvoice->itemDetails
        ]);
    }

    public function printInvoice() {
        $invoice = Invoice::find(request('invoice'));
        $details = $invoice->preInvoice->itemDetails;

        return view('pages.invoice.final.print', [
            'invoice' => $invoice,
            'details' => $details
        ]);
    }

    public function makePayment(Request $request) {
       try {
            $invoice = Invoice::find($request->invoice);
            $paymentDate = $request->payment_date;
            $paymentAmount = $request->payment_amount;
            $paymentMethod = $request->payment_mode;

            $alreadyPaidAmount = $invoice->preInvoice->total_ttc - $invoice->paid_amount;
            
            if ($paymentAmount < $invoice->preInvoice->total_ttc) {
                $status = 'partialy_paid';

                if (!$invoice->remaining_amount == 0) {
                    $invoice->update([
                        'remaining_amount' => $invoice->remaining_amount - $paymentAmount,
                    ]);
                } else {
                    $invoice->update([
                        'remaining_amount' => $invoice->preInvoice->total_ttc - $paymentAmount,
                    ]);
                }

            } else {
                $status = 'paid';
            }
            Payment::create([
                'invoice_id' => $invoice->id,
                'payment_amount' => $paymentAmount,
                'payment_date' => $paymentDate,
                'payment_method' => $paymentMethod,
            ]);

            if ($invoice->remaining_amount == 0 ) {
                $status = 'paid';
            } else {
                $status = 'partialy_paid';
            }
            $invoice->update([
                'paid_amount' => $invoice->paid_amount + $paymentAmount,
                'payment_date' => $paymentDate,
                'status' => $status,
            ]);
       } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
       }

        return response()->json(['message' => "Payment registered successfully"]);
    }
}
