<x-main>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Historique des paiements de la facture : {{ $invoice->preinvoice->reference }}</h3>
                    <a href="{{ route('final-invoices.index') }}" class="text-right btn btn-link">Retour à liste des factures</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date de paiement</th>
                                <th>Montant payé</th>
                                <th>Montant restant</th>
                                <th>Mode de paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                    <td>${{ number_format($payment->payment_amount, 2, '.', ',') }}</td>
                                    <td>{{ $payment->remaining_amount > 0 ? "$" . number_format($payment->remaining_amount, 2, '.', ',') : '---'}}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-main>