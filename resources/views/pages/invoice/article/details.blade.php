<x-main>
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12">
                @role(['manager', 'admin'])
                @if ($preInvoice->status === 'rejected')
                <div class="alert alert-warning fade show" role="alert">
                    <div class="alert-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info mr-50 align-middle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>La présente facture est en attente de modification ou de correction</span>
                    </div>
                </div>
                @endif
                @endrole

                @role('cashier')
                @if ($preInvoice->status === 'pending')
                <div class="alert alert-warning fade show" role="alert">
                    <div class="alert-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info mr-50 align-middle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>La présente facture est en attente de validation</span>
                    </div>
                </div>
                @endif

                @if ($preInvoice->status === 'rejected')
                <div class="alert alert-warning fade show" role="alert">
                    <div class="alert-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info mr-50 align-middle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>La présente facture nécéssite une correction</span>
                    </div>
                </div>
                @endif
                @endrole
                <div class="alert alert-success alert-dismissible fade show" id="_alert_el" role="alert">
                    <div class="alert-body" id="_alert_msg">

                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show" id="_alert_error" role="alert">
                    <div class="alert-body" id="_error_alert_msg">

                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                <div class="logo-wrapper">
                                    <img src="{{ asset('app-assets/images/logo/logo.png') }}" width="150" alt="logo">
                                </div>
                                <!-- <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> -->
                            </div>
                            <div class="mt-md-0 mt-2">
                                <h4 class="invoice-title">
                                    Facture :
                                    <span class="invoice-number">{{ $preInvoice->reference }}</span>
                                </h4>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">Date :</p>
                                    <p class="invoice-date">{{ date('d/m/Y', strtotime($preInvoice->issue_date))}}</p>
                                </div>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">Date d'échéance:</p>
                                    <p class="invoice-date">{{ date('d/m/Y', strtotime($preInvoice->expiry_date))}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>

                    <hr class="invoice-spacing" />

                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row invoice-spacing">
                            <div class="col-xl-8 p-0">
                                <h6 class="mb-2">Facturé à :</h6>
                                <h6 class="mb-25">{{ $preInvoice->client['name'] }}</h6>
                                <p class="card-text mb-25">{{ $preInvoice->client['contact'] }}</p>
                                <p class="card-text mb-25">{{ $preInvoice->client['address'] }}</p>
                                <p class="card-text mb-25">{{ $preInvoice->client['phone'] }}</p>
                                <p class="card-text mb-0">{{ $preInvoice->client['email'] }}</p>
                            </div>
                            <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                <!-- <h6 class="mb-2">Payment Details:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pr-1">Total Due:</td>
                                            <td><span class="font-weight-bold">$12,110.55</span></td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                    <!-- Address and Contact ends -->

                    <!-- Invoice Description starts -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="py-1">Description service</th>
                                    <th class="py-1">Prix unitaire</th>
                                    <th class="py-1">Quantité</th>
                                    <th class="py-1">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($details)
                                @foreach($details as $detail)
                                <tr>
                                    <td class="py-1">
                                        <p class="card-text font-weight-bold mb-25">{{ $detail->article['name'] }}</p>
                                        <p class="card-text text-nowrap">
                                            {{ $detail->article['description'] }}
                                        </p>
                                    </td>
                                    <td class="py-1">
                                        <span class="font-weight-bold">${{ number_format($detail->article['unit_price'], 2, '.', ',') }}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="font-weight-bold">{{ $detail->quantity}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="font-weight-bold">${{ number_format($detail->total_amount, 2, '.', ',') }}</span>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body invoice-padding pb-0">
                        <div class="row invoice-sales-total-wrapper">
                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                <!-- <p class="card-text mb-0">
                                    <span class="font-weight-bold">Salesperson:</span> <span class="ml-75">Alfie Solomons</span>
                                </p> -->
                            </div>
                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                <div class="invoice-total-wrapper">
                                    <!-- <div class="invoice-total-item">
                                        <p class="invoice-total-title">Subtotal:</p>
                                        <p class="invoice-total-amount">$1800</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Discount:</p>
                                        <p class="invoice-total-amount">$28</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Tax:</p>
                                        <p class="invoice-total-amount">21%</p>
                                    </div> -->
                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Total:</p>
                                        <p class="invoice-total-amount">${{ number_format($totalPrice, 2, '.', ',') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Description ends -->

                    <hr class="invoice-spacing" />

                    <!-- Invoice Note starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row">
                            <div class="col-12">
                                <!-- <span class="font-weight-bold">Note:</span> -->
                                <!-- <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                    projects. Thank You!</span> -->
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Note ends -->
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                <div class="card">
                    <div class="card-body">
                        <!-- <button class="btn btn-primary btn-block mb-75" data-toggle="modal" data-target="#send-invoice-sidebar">
                            Send Invoice
                        </button> -->
                        <!-- <button class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Download</button>
                        <a class="btn btn-outline-secondary btn-block mb-75" href="./app-invoice-print.html" target="_blank">
                            Print
                        </a> -->
                        @role('cashier')
                        @if ($preInvoice->status === 'draft')
                        <button class="btn btn-primary btn-block mb-75 waves-effect" onclick="sendForValidation()" id="_validation_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-25">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Envoyer pour validation</span>
                        </button>
                        <a class="btn btn-outline-secondary btn-block mb-75" href="{{ route('articles.invoices.edit', $preInvoice->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                            <span>Modifier</span>
                        </a>
                        @endif
                        @endrole

                        @role(['admin', 'manager'])
                        @if ($preInvoice->status === 'pending')
                        <button class="btn btn-outline-primary btn-block mb-75 waves-effect" onclick="valdateInvoice()" id="_validate_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-25">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Valider</span>
                        </button>
                        <a class="btn btn-outline-danger btn-block mb-75" onclick="rejectInvoice()" id="_reject_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            <span>Rejeter</span>
                        </a>

                        @endif

                        @if ($preInvoice->status === 'validated')
                        <a class="btn btn-outline-info btn-block mb-75" onclick="convertToInvoice()" id="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span>Transformer en facture</span>
                        </a>
                        @endif
                        @endrole
                        <a class="btn btn-outline-success btn-block mb-75 waves-effect" href="{{ route('articles.invoices.print', $preInvoice->id) }}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            <span>Imprimer</span>
                        </a>

                        <!-- <button class="btn btn-success btn-block" data-toggle="modal" data-target="#add-payment-sidebar">
                            Add Payment
                        </button> -->
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </section>
    <script>
        var alert = document.querySelector("#_alert_el");
        var errorAlert = document.querySelector("#_alert_error");
        alert.style.display = 'none';
        errorAlert.style.display = 'none';

        let invoiceId = `{{ $preInvoice->id }}`;

        let validatedBtn = document.querySelector("#_validate_btn");
        let validationBtn = document.querySelector("#_validation_btn");
        let rejectBtn = document.querySelector("#_reject_btn");

        function valdateInvoice() {
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            $.ajax({
                url: `{{ route('articles.invoices.validate', ':id') }}`.replace(':id', invoiceId),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log("Validation success : ", response.status);
                    if (response) {
                        alert.style.display = 'block';
                        alertMsg.innerHTML = "Facture validée avec succès";

                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 5000);

                        validatedBtn.style.display = 'none';
                        rejectBtn.style.display = 'none';
                        window.location.reload();
                    }
                },
                error: function(error) {
                    errorAlert.style.display = 'block';
                    errorAlertMsg.innerHTML = "Erreur lors de la validation de la facture";

                    setTimeout(function() {
                        errorAlert.style.display = 'none';
                    }, 5000);
                    console.log("Validation error : ", error);
                }
            });
        }

        function sendForValidation() {
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            $.ajax({
                url: `{{ route('articles.invoices.sendForValidation', ':id') }}`.replace(':id', invoiceId),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response) {
                        alert.style.display = 'block';
                        alertMsg.innerHTML = "Facture envoyée pour validation avec succès!";

                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 5000);

                        validationBtn.style.display = 'none';
                        window.location.reload();
                    }
                }
            })
        }

        function rejectInvoice() {
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            $.ajax({
                url: `{{ route('articles.invoices.reject', ':id') }}`.replace(':id', invoiceId),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response) {
                        errorAlert.style.display = 'block';
                        errorAlertMsg.innerHTML = "La facture a été rejetée!";

                        setTimeout(function() {
                            errorAlert.style.display = 'none';
                        }, 5000);

                        validationBtn.style.display = 'none';
                        rejectBtn.style.display = 'none';

                        window.location.reload();
                    }
                },
                error: function(error) {
                    errorAlert.style.display = 'block';
                    errorAlertMsg.innerHTML = "Erreur lors de la validation de la facture";

                    setTimeout(function() {
                        errorAlert.style.display = 'none';
                    }, 5000);
                    console.log("Validation error : ", error);
                }
            })
        }

        function convertToInvoice() {
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            $.ajax({
                url: `{{ route('articles.invoices.toInvoice', ':id') }}`.replace(':id', invoiceId),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response) {
                        alert.style.display = 'block';
                        alertMsg.innerHTML = "La proformat a été transformée en une facture avec succès!";

                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 5000);

                        validationBtn.style.display = 'none';
                        rejectBtn.style.display = 'none';

                        window.location.reload();
                    }
                },
                error: function(error) {
                    errorAlert.style.display = 'block';

                    setTimeout(function() {
                        errorAlert.style.display = 'none';
                    }, 5000);

                    if (error.status === 400) {
                        errorAlertMsg.innerHTML = "La proformat a déjà été cconvertie en facture!";
                    }
                    // console.log("Validation error : ", error.status);
                }
            })
        }
    </script>
</x-main>