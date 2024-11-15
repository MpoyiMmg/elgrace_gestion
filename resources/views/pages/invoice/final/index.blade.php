<x-main>
    <section class="invoice-list-wrapper">
        <div class="card">
            <div class="card-header">
                @role ('cashier')
                <a href="{{ route('articles.invoices.create') }}" class="btn btn-primary">
                    Créer une facture
                </a>
                @endrole
            </div>
            <div class="card-datatable table-responsive">
                @if (count($invoices))
                <table class="invoice-list-table table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Référence</th>
                            <th>Client</th>
                            <th>Total à payer</th>
                            <th>Statut</th>
                            <th class="cell-fit">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($invoices)
                        @role('cashier')
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" class="form-check-input invoice-list-checkbox" id="invoice-{{ $invoice->id }}">
                                <label class="form-check-label" for="invoice-{{ $invoice->id }}"></label>
                            </td>
                            <td>
                                {{ $invoice->reference }}
                            </td>
                            <td>
                                <i data-feather="user"></i>
                                {{ $invoice->preInvoice->client['name'] }}
                            </td>
                            <td>${{ number_format($invoice->preInvoice->total_ttc, 2, '.', ',') }}</td>
                            <td>
                                @if ($invoice->status === 'partialy_paid')
                                    <div class="badge badge-info">Payée partillement</div>
                                @elseif ($invoice->status === 'unpaid')
                                    <div class="badge badge-warning">En attente de paiement</div>
                                @else
                                    <div class="badge badge-success">Payée</div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu ">
                                        <a class="dropdown-item" href="{{ route('final-invoices.details', $invoice->id) }}">
                                            <i data-feather="eye" class="mr-50"></i>
                                            <span>Détails</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i data-feather="trash" class="mr-50"></i>
                                            <span>Supprimer</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endrole

                        @role(['admin', 'manager'])
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" class="form-check-input invoice-list-checkbox" id="invoice-{{ $invoice->id }}">
                                <label class="form-check-label" for="invoice-{{ $invoice->id }}"></label>
                            </td>
                            <td>
                                {{ $invoice->reference }}
                            </td>
                            <td>
                                <i data-feather="user"></i>
                                {{ $invoice->preInvoice->client['name'] }}
                            </td>
                            <td>${{ number_format($invoice->preInvoice->total_ttc, 2, '.', ',') }}</td>
                            <td>
                                @if ($invoice->status === 'unpaid')
                                    <div class="badge badge-warning">En attente de paiement</div>
                                @elseif ($invoice->status === 'paid')
                                    <div class="badge badge-success">Payée</div>
                                @else
                                    <div class="badge badge-info">Payée partillement</div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('final-invoices.details', $invoice->id) }}">
                                            <i data-feather="eye" class="mr-50"></i>
                                            <span>Voir détails</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i data-feather="trash" class="mr-50"></i>
                                            <span>Supprimer</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endrole
                        @endif
                    </tbody>
                </table>
                @else
                <tr>
                    <div class="w-100 d-lg-flex align-items-center justify-content-center px-5 mb-4">
                        <img class="img-fluid" src="{{ asset('app-assets/images/pages/error.svg') }}" alt="Empty data" />
                    </div>
                    <div class="d-lg-flex align-items-center justify-content-center mb-4">
                        @role('cashier')
                        <h3>Aucune facture n'a été trouvée, veuillez en ajouter!</h3>
                        @else
                        <h3>Aucune facture n'a été trouvée!</h3>
                        @endrole
                    </div>
                </tr>
                @endif
            </div>
        </div>
    </section>
</x-main>