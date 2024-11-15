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
                @if (count($preInvoices))
                <table class="invoice-list-table table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Référence</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th class="text-truncate">Issued Date</th>
                            <th>Invoice Status</th>
                            <th class="cell-fit">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($preInvoices)
                        @role('cashier')
                        @foreach ($preInvoices as $invoice)
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
                                {{ $invoice->client['name'] }}
                            </td>
                            <td>${{ number_format($invoice->total_amount, 2, '.', ',') }}</td>
                            <td class="text-truncate">{{ date('d-m-Y', strtotime($invoice->issue_date)) }}</td>
                            <td>
                                @if ($invoice->status === 'draft')
                                    <div class="badge badge-info">En cours de création</div>
                                @elseif ($invoice->status === 'pending')
                                    <div class="badge badge-warning">En attente de validation</div>
                                @elseif ($invoice->status === 'validated')
                                    <div class="badge badge-success">Facture prête à être envoyée</div>
                                @elseif ($invoice->status === 'accepted')
                                    <div class="badge badge-secondary">Proformat convertie en facture</div>
                                @else
                                    <div class="badge badge-danger">Facture à corriger</div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu ">
                                        <a class="dropdown-item" href="{{ route('articles.invoices.show', $invoice->id) }}">
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
                        @foreach ($preInvoices as $invoice)
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
                                {{ $invoice->client['name'] }}
                            </td>
                            <td>${{ number_format($invoice->total_amount, 2, '.', ',') }}</td>
                            <td class="text-truncate">{{ date('d-m-Y', strtotime($invoice->issue_date)) }}</td>
                            <td>
                                @if ($invoice->status === 'pending')
                                    <div class="badge badge-warning">Proformat à valider</div>
                                @elseif ($invoice->status === 'validated')
                                    <div class="badge badge-success">Proformat prête à être envoyée</div>
                                @elseif ($invoice->status === 'accepted')
                                    <div class="badge badge-success">Proformat convertie en facture</div>
                                @else
                                    <div class="badge badge-danger">En attente de correction</div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('articles.invoices.show', $invoice->id) }}">
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