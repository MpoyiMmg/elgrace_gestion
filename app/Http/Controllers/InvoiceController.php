<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Module;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::all();
        $modules = Module::all();

        return view('pages.invoice.final.index', [
            'invoices' => $invoices,
            'modules' => $modules
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
            $remainingAmount = 0;
            if ($paymentAmount < $invoice->preInvoice->total_ttc) {
                $status = 'partialy_paid';
                //  dd("here");
                if (!$invoice->remaining_amount == 0) {
                    $remainingAmount = $invoice->remaining_amount - $paymentAmount;
                    $invoice->update([
                        'remaining_amount' => $remainingAmount,
                    ]);
                } else {
                    $remainingAmount = $invoice->preInvoice->total_ttc - $paymentAmount;
                    $invoice->update([
                        'remaining_amount' => $remainingAmount,
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
                'remaining_amount' => $remainingAmount
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
    
    public function historicPayments(Request $request) {
        $invoice = Invoice::find($request->invoice);
        $payments = $invoice->payments;
        return view('pages.invoice.final.historic_payments', [
            'invoice' => $invoice,
            'payments' => $payments,
        ]);
    }
}
