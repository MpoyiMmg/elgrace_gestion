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
                                @if($preInvoice->module->code === 'LCV')
                                <tr>
                                    <th class="py-1">Description service</th>
                                    <th class="py-1">Prix unitaire</th>
                                    <th class="py-1">Quantité</th>
                                    <th class="py-1">Total</th>
                                </tr>
                                @else
                                <tr>
                                    <th class="py-1">Module</th>
                                    <th class="py-1">Intitulé du service</th>
                                    <th class="py-1">Total</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if($preInvoice->module->code === 'LCV')
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
                                @else
                                @if($details)
                                @foreach($details as $detail)
                                <tr>
                                    <td class="py-1">
                                        <p class="card-text font-weight-bold mb-25">{{ $preInvoice->module->name }}</p>
                                    </td>
                                    <td class="py-1">
                                        <p class="card-text font-weight-bold mb-25">{{ $detail->module_invoice_details }}</p>
                                    </td>
                                    <td class="py-1">
                                        <span class="font-weight-bold">${{ number_format($preInvoice->total_ht, 2, '.', ',') }}</span>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title font-weight-bold">Total HT:</p>
                                        <p class="invoice-total-amount">${{ number_format($preInvoice->total_ht, 2, '.', ',') }}</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title font-weight-bold">TVA (16%):</p>
                                        <p class="invoice-total-amount">${{ number_format($preInvoice->tva, 2, '.', ',') }}</p>
                                    </div>
                                    @if ($preInvoice->reduction_rate > 0)
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title font-weight-bold">Réd. ({{ $preInvoice->reduction_rate }}%):</p>
                                        <p class="invoice-total-amount">${{ number_format($preInvoice->reduction_ht, 2, '.', ',') }}</p>
                                    </div>
                                    @endif
                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Total TTC:</p>
                                        @if ($preInvoice->module === 'LCV')
                                        <p class="invoice-total-amount">${{ number_format($totalPrice, 2, '.', ',') }}</p>
                                        @else
                                        <p class="invoice-total-amount">${{ number_format($preInvoice->total_ttc, 2, '.', ',') }}</p>
                                        @endif
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
                        <button class="btn btn-outline-primary btn-block" type="button" id="_loading_btn" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Loading...</span>
                        </button>
                        <button class="btn btn-primary btn-block mb-75 waves-effect" onclick="sendForValidation()" id="_validation_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-25">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Envoyer pour validation</span>
                        </button>
                        @endif
                        @if ($preInvoice->status === 'draft' || $preInvoice->status === 'rejected')
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
                        <button class="btn btn-outline-primary btn-block" type="button" id="_loading_btn" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Loading...</span>
                        </button>
                        <button class="btn btn-outline-primary btn-block mb-75 waves-effect" onclick="valdateInvoice()" id="_validate_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-25">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Valider</span>
                        </button>
                        <a class="btn btn-outline-danger btn-block mb-75 waves-effect" onclick="rejectInvoice()" id="_reject_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            <span>Rejeter</span>
                        </a>

                        @endif

                        @if ($preInvoice->status === 'validated')
                        <button class="btn btn-outline-primary btn-block" type="button" id="_loading_btn" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Loading...</span>
                        </button>
                        <a class="btn btn-outline-info btn-block mb-75" onclick="convertToInvoice()" id="_convert_btn">
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

                @if ($comments->count() > 0)
                @if ($preInvoice->status === 'rejected' || $preInvoice->status === 'draft')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Commentaires</h3>
                    </div>
                    <div class="card-body">
                        <div id="comments_container">
                            @if ($comments->count() > 0)
                            @foreach ($comments as $comment)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="media">
                                        <div class="media-body">
                                            <!-- <h5 class="mt-0 mb-1"><strong>{{ $comment->content }}</strong></h5> -->
                                            <p>{{ $comment->content }}</p>
                                            <p class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
        </div>
        <!-- /Invoice Actions -->
        </div>
        <!-- modal -->
        <div class="modal fade text-left" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Ajouter un commentaire</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Donner une explication sur la rejection</label>
                            <textarea class="form-control" id="_content" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="_send_comment_btn" onclick="addComment()">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
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
        let convertBtn = document.querySelector("#_convert_btn");

        let loadingBtn = document.querySelector("#_loading_btn");

        if (loadingBtn !== null) {
            loadingBtn.style.display = 'none';
        }

        function valdateInvoice() {
            loadingBtn.style.display = 'block';
            validatedBtn.style.display = 'none';
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
                            validatedBtn.style.display = 'block';
                            loadingBtn.style.display = 'none';
                        }, 5000);

                        // validatedBtn.style.display = 'none';
                        // rejectBtn.style.display = 'none';
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
            validationBtn.style.display = 'none';
            loadingBtn.style.display = 'block';
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
                            validationBtn.style.display = 'block';
                            loadingBtn.style.display = 'none';
                        }, 5000);

                        validationBtn.style.display = 'none';
                        window.location.reload();
                    }
                }
            })
        }

        function rejectInvoice() {
            $('#comment_modal').modal('show');
            // console.log("modal : ", $('#comment_modal'));
        }

        function convertToInvoice() {
            convertBtn.style.display = "none";
            loadingBtn.style.display = 'block';

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
                            convertBtn.style.display = 'block';
                            loadingBtn.style.display = 'none';
                        }, 5000);
                    }
                    window.location.reload();
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

        function addComment() {
            let comment = document.querySelector('#_content').value;
            loadingBtn.style.display = 'block';
            validatedBtn.style.display = 'none';
            rejectBtn.style.display = 'none';
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            $.ajax({
                url: `{{ route('articles.invoices.reject', ':id') }}`.replace(':id', invoiceId),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    comment: comment
                },
                success: function(response) {
                    if (response) {
                        errorAlert.style.display = 'block';
                        errorAlertMsg.innerHTML = "La facture a été rejetée!";

                        setTimeout(function() {
                            errorAlert.style.display = 'none';
                            validationBtn.style.display = 'block';
                            rejectBtn.style.display = 'block';
                            loadingBtn.style.display = 'none';
                        }, 5000);

                        comment.value = "";
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
            // console.log("content : ", content.value);
        }
    </script>
</x-main>