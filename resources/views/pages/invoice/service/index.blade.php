<x-main>
    <section class="invoice-list-wrapper">
        <div class="card">
            <div class="card-header">
                    <a href="{{ route('services.invoices.create') }}" class="btn btn-primary">
                        Ajouter une facture
                    </a>
                </div>
            <div class="card-datatable table-responsive">
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
                                            <div class="badge badge-warning">En attente</div>
                                            <!-- <span class="badge badge-pill badge-soft-primary font-size-sm">{{ $invoice->status}}</span> -->
                                        @endif
                                    </td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('services.invoices.show', $invoice->id) }}">
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
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-main>