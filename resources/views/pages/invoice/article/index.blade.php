<x-main>
    <section class="invoice-list-wrapper">
        <div class="card">
            <div class="card-header">
                <!-- Alert message -->
                <div id="alert" style="display: none;">
                    <p id="_alert_msg"></p>
                </div>
                @role('cashier')
                <button type="button" class="btn btn-primary" id="selectAllBtn">Sélectionner tout</button>
                @endrole

                @role('cashier')
                <a href="{{ route('articles.invoices.create') }}" class="btn btn-primary">
                    Créer une facture
                </a>
                @endrole

                @role(['admin', 'manager'])
                <a href="{{ route('articles.invoices.create') }}" class="btn btn-primary">
                    Créer une facture
                </a>
                @endrole

                <div class="btn-group dropdown-sort">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle mr-1 waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="active-sorting">Modules</span>
                    </button>
                    <div class="dropdown-menu">
                        @foreach($modules as $module)
                        <a class="dropdown-item" href="javascript:void(0);">{{ $module->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-datatable table-responsive">
                @if (count($preInvoices))
                    @csrf
                    <table class="invoice-list-table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Référence</th>
                                <th>Module</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th class="text-truncate">Issued Date</th>
                                <th>Invoice Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($preInvoices as $invoice)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input invoice-list-checkbox" value="{{ $invoice->id }}" id="invoice-{{ $invoice->id }}">
                                </td>
                                <td>{{ $invoice->reference }}</td>
                                <td>{{ $invoice->module->name }}</td>
                                <td><i data-feather="user"></i> {{ $invoice->client['name'] }}</td>
                                <td>${{ number_format($invoice->total_amount, 2, '.', ',') }}</td>
                                <td class="text-truncate">{{ date('d-m-Y', strtotime($invoice->issue_date)) }}</td>
                                <td>
                                    @role('admin')
                                    @if ($invoice->status === 'draft')
                                        <div class="badge badge-info">En cours de création</div>
                                    @elseif ($invoice->status === 'pending')
                                        <div class="badge badge-warning">Proformat à valider</div>
                                    @elseif ($invoice->status === 'validated')
                                        <div class="badge badge-success">Facture prête à être envoyée</div>
                                    @elseif ($invoice->status === 'accepted')
                                        <div class="badge badge-secondary">Proformat convertie en facture</div>
                                    @else
                                        <div class="badge badge-danger">En attente de correction</div>
                                    @endif
                                @endrole

                                    @role('cashier')
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
                                    @endrole
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
                        </tbody>
                    </table>
                @else
                <tr>
                    <td colspan="9" class="text-center">
                        <img class="img-fluid" src="{{ asset('app-assets/images/pages/error.svg') }}" alt="Empty data" />
                        <h3>Aucune proformat n'a été trouvée!</h3>
                    </td>
                </tr>
                @endif
            </div>
        </div>

        @role('cashier')
        <button type="button" class="btn btn-success" id="sendForValidationBtn" disabled>
            <span id="btnText">Envoyer pour validation</span>
            <span id="loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
        </button>
        @endrole
    </section>

    <script>
        document.getElementById('selectAllBtn').addEventListener('click', function () {
            var checkboxes = document.querySelectorAll('.invoice-list-checkbox');
            var allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = !allSelected;
            });
            checkIfValidInvoicesSelected(); 
        });

        function checkIfValidInvoicesSelected() {
            var selectedInvoices = document.querySelectorAll('.invoice-list-checkbox:checked');
            var validInvoiceSelected = false;

            selectedInvoices.forEach(function (checkbox) {
                var invoiceRow = checkbox.closest('tr');
                var statusCell = invoiceRow.querySelector('td:nth-child(7)');
                var status = statusCell.textContent.trim();

                if (status === 'En attente de validation' || status === 'Facture à corriger') {
                    validInvoiceSelected = true;
                }
            });

            var sendButton = document.getElementById('sendForValidationBtn');
            sendButton.disabled = !validInvoiceSelected; 
        }
        document.getElementById('sendForValidationBtn').addEventListener('click', function () {
            var selectedInvoices = document.querySelectorAll('.invoice-list-checkbox:checked');
            if (selectedInvoices.length === 0) {
                alert('Veuillez sélectionner des factures à valider.');
            } else {
                var invoiceIds = [];
                selectedInvoices.forEach(function (checkbox) {
                    var invoiceRow = checkbox.closest('tr');
                    var statusCell = invoiceRow.querySelector('td:nth-child(7)');
                    var status = statusCell.textContent.trim();

                    if (status === 'En attente de validation' || status === 'Facture à corriger') {
                        invoiceIds.push(checkbox.getAttribute('value'));
                    }
                });

                if (invoiceIds.length > 0) {
                    sendForValidation(invoiceIds);
                } else {
                    alert('Aucune facture valide sélectionnée.');
                }
            }
        });

        function sendForValidation(invoiceIds) {
            var alert = document.querySelector("#alert");  
            var alertMsg = document.querySelector("#_alert_msg");
            var sendButton = document.getElementById('sendForValidationBtn');
            var loader = document.getElementById('loader');
            var btnText = document.getElementById('btnText');

            if (!alert) {  
                console.error("L'élément 'alert' n'a pas été trouvé dans le DOM.");
                return;  
            }

            sendButton.disabled = true;
            loader.style.display = 'inline-block';
            btnText.style.display = 'none';

            $.ajax({
                url: `{{ route('articles.invoices.sendForValidation',':id') }}`,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    invoices: invoiceIds 
                },
                success: function(response) {
                    if (response.success) {
                        alertMsg.innerHTML = "Les factures ont été envoyées pour validation avec succès!";
                        alert.style.display = 'block'; 

                        setTimeout(function() {
                            alert.style.display = 'none';  
                            window.location.reload(); 
                        }, 5000);
                    } else {
                        alertMsg.innerHTML = "Une erreur s'est produite. Veuillez réessayer.";
                    }
                },
                error: function() {
                    alertMsg.innerHTML = "Une erreur s'est produite. Veuillez réessayer.";
                },
                complete: function() {
                    document.querySelectorAll('.invoice-list-checkbox').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    sendButton.disabled = false;
                    loader.style.display = 'none';
                    btnText.style.display = 'inline-block';
                }
            });
        }
    </script>
</x-main>
