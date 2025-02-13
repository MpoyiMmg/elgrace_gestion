<x-main>
    <section class="invoice-add-wrapper">
        <div class="row invoice-add">
            <!-- Invoice Add Left starts -->
            <div class="col-xl-9 col-md-8 col-12">
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
                    <!-- Header starts -->
                    <div class="card-body invoice-padding pb-0">
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                <div class="logo-wrapper">
                                    <img src="{{ asset('app-assets/images/logo/logo.png') }}" width="150" alt="logo">
                                </div>
                                <!-- <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> -->
                            </div>
                            <div class="invoice-number-date mt-md-0 mt-2">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="title">Date:</span>
                                    <input type="text" id="_creation_date" class="form-control invoice-edit-input flatpickr-basic" placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="title">Date d'échéance:</span>
                                    <input type="text" id="_due_date" class="form-control invoice-edit-input flatpickr-basic" placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->

                    <hr class="invoice-spacing" />

                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row row-bill-to invoice-spacing">
                            <div class="col-xl-5 mb-lg-1 col-bill-to pl-0">
                                <h6 class="invoice-to-title">Facturé à :</h6>
                                <div class="invoice-customer">
                                    <select class="invoiceto form-control" id="_selected_client" onchange="activeSaveBtn()">
                                        <option value="" disabled selected> Veuillez séléctionner un client</option>
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-5 mb-lg-1 col-bill-to pl-0">
                                <h6 class="invoice-to-title">Module </h6>
                                <div class="invoice-customer">
                                    <select class="form-control item-details" id="_module" name="module" onchange="selectModule()">
                                        <option value="" selected disabled>Selectionner le module à facturer</option>
                                        @foreach($modules as $module)
                                        <option value="{{ $module }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 pr-0 mt-xl-0 mt-2">
                                <!-- <h6 class="mb-2">Payment Details:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pr-1">Total Due:</td>
                                            <td><strong>$12,110.55</strong></td>
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
                        <hr>
                    </div>
                    <!-- Address and Contact ends -->
                    <!-- Product Details starts -->
                    <div class="card-header">
                        <div class="row ml-1">
                            <div class="col-12">
                                <h6 class="card-title">Détails du service à facturer</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body invoice-padding invoice-product-details">
                        <form class="source-item" id="_locationForm">
                            <div data-repeater-list="group-a">
                                <div class="repeater-wrapper" data-repeater-item>
                                    <div class="row">
                                        <div class="col-12 d-flex product-details-border position-relative pr-0">
                                            <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                <div class="col-lg-3 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                    <p class="card-text col-title mb-md-50 mb-0">Article</p>
                                                    <select class="form-control item-details" id="_article" onchange="selectArticle()">
                                                        <option value="" selected disabled>Selectionner un article</option>
                                                        @foreach($articles as $article)
                                                        <option value="{{ $article }}">{{ $article->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <textarea class="form-control mt-2" rows="1">Customization & Bug Fixes</textarea> -->
                                                </div>
                                                <div class="col-lg-3 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                    <p class="card-text col-title mb-md-50 mb-0">Service</p>
                                                    <select class="form-control item-details" id="_service">
                                                        <option value="" selected disabled>Selectionner un service</option>
                                                        <option value="">Aucun service</option>
                                                        @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <textarea class="form-control mt-2" rows="1">Customization & Bug Fixes</textarea> -->
                                                </div>
                                                <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                    <p class="card-text col-title mb-md-2 mb-0">Prix unitaire</p>
                                                    <input type="text" class="form-control" value="0" id="_price" placeholder="0" />
                                                    <!-- <div class="mt-2">
                                                        <span>Discount:</span>
                                                        <span class="discount">0%</span>
                                                        <span class="tax-1 ml-50" data-toggle="tooltip" data-placement="top" title="Tax 1">0%</span>
                                                        <span class="tax-2 ml-50" data-toggle="tooltip" data-placement="top" title="Tax 2">0%</span>
                                                    </div> -->
                                                </div>
                                                <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                    <p class="card-text col-title mb-md-2 mb-0">Quantité</p>
                                                    <div class="input-group input-group-lg">
                                                        <input type="number" class="touchspin" value="0" name="stock" id="_quantity" onchange="calculOfPrice()" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                    <p class="card-text col-title mb-md-50 mb-0">Prix total</p>
                                                    <p class="card-text mb-0 mt-0" id="_price_text">$0.0</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12 px-0">
                                    <button type="button" class="btn btn-primary btn-sm btn-add-new" id="_add_Item_btn" onclick="addItem()">
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span class="align-middle">Ajouter à la facture</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form class="source-item" id="_otherModuleForm">
                            <div data-repeater-list="group-a">
                                <div class="repeater-wrapper" data-repeater-item>
                                    <div class="row">
                                        <div class="col-12 d-flex product-details-border position-relative pr-0">
                                            <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                <div class="col-lg-4 col-12 my-lg-0 my-2">
                                                    <p class="card-text col-title mb-md-2 mb-0">Intitulé du service</p>
                                                    <input type="text" class="form-control" value="" id="_service_details" placeholder="Ex: Nettoyage des bureaux ou Obtention licence" />
                                                </div>
                                                <div class="col-lg-4 col-12 my-lg-0 my-2">
                                                    <p class="card-text col-title mb-md-2 mb-0">Prix unitaire</p>
                                                    <input type="number" class="form-control" min="0" value="0" id="_module_price" oninput="setModulePrice()" />
                                                </div>
                                                <div class="col-lg-4 col-12 mt-lg-0 mt-2">
                                                    <p class="card-text col-title mb-md-50 mb-0">Prix total</p>
                                                    <p class="card-text mb-0 mt-0" id="_module_price_text">$0.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12 px-0">
                                    <button type="button" class="btn btn-primary btn-sm btn-add-new" id="_add_Item_btn" onclick="addModuleItem()">
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span class="align-middle">Ajouter à la facture</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr class="mt-3">
                    </div>
                    <!-- Product Details ends -->
                    <div class="card-body invoice-padding">
                        <div class="row">
                            <div class="col-12 d-flex product-details-border position-relative pr-0 mb-1">
                                <h6>Détails de la facture</h6>
                            </div>
                        </div>
                        <div class="row" id="_locaton_details">
                            <div class="col-12 d-flex product-details-border position-relative pr-0">
                                <div class="table-responsive">
                                    <table class="table" id="items-table">
                                        <thead>
                                            <tr>
                                                <th class="py-1">Article</th>
                                                <th class="py-1">Prix unitaire</th>
                                                <th class="py-1">Quantité</th>
                                                <th class="py-1">Total</th>
                                                <th class="py-1"></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="_other_details">
                            <div class="col-12 d-flex product-details-border position-relative pr-0">
                                <div class="table-responsive">
                                    <table class="table" id="items-module-table">
                                        <thead>
                                            <tr>
                                                <th class="py-1">Module</th>
                                                <th class="py-1">Intitulé du service</th>
                                                <th class="py-1">Prix</th>
                                                <th class="py-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Total starts -->
                    <div class="card-body invoice-padding">
                        <div class="row invoice-sales-total-wrapper">
                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                <div class="d-flex align-items-center mb-1">
                                    <!-- <label for="salesperson" class="form-label">Salesperson:</label>
                                    <input type="text" class="form-control ml-50" id="salesperson" placeholder="Edward Crowley" /> -->
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                <div class="invoice-total-wrapper">
                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Total:</p>
                                        <p class="invoice-total-amount" id="_total_invoice_price_text">$0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Total ends -->

                    <hr class="invoice-spacing mt-0" />

                    <div class="card-body invoice-padding py-0">
                        <!-- Invoice Note starts -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <!-- <label for="note" class="form-label font-weight-bold">Note:</label>
                                    <textarea class="form-control" rows="2" id="note">
                                        It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea> -->
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
            </div>
            <!-- Invoice Add Left ends -->

            <!-- Invoice Add Right starts -->
            <div class="col-xl-3 col-md-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <button class="btn btn-primary btn-block mb-75" disabled>Send Invoice</button> -->
                        <!-- <a href="./app-invoice-preview.html" class="btn btn-outline-primary btn-block mb-75">Preview</a> -->
                        <button class="btn btn-outline-primary btn-block" type="button" id="_loading_btn" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Loading...</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-block" id="_save_btn" onclick="saveModuleInvoice()">Enregistrer</button>
                        <button type="button" class="btn btn-primary btn-block" id="_other_save_btn" onclick="saveInvoice()">Enregistrer</button>
                    </div>
                </div>
            </div>
            <!-- Invoice Add Right ends -->
        </div>
    </section>
    <script>
        let unitPrice = 0;
        var addItemBtn = document.querySelector("#_add_Item_btn");
        var saveBtn = document.querySelector("#_save_btn");
        var loadingBtn = document.querySelector("#_loading_btn");
        var alert = document.querySelector("#_alert_el");
        var errorAlert = document.querySelector("#_alert_error");
        var moduleValue = document.querySelector("#_module");
        var otherModuleForm = document.querySelector('#_otherModuleForm');
        var locationDetails = document.querySelector('#_locaton_details');
        var otherDetails = document.querySelector('#_other_details');
        var otherSaveBtn = document.querySelector('#_other_save_btn');
        var saveBtn = document.querySelector('#_save_btn');


        alert.style.display = 'none';
        errorAlert.style.display = 'none';
        loadingBtn.style.display = 'none';
        otherDetails.style.display = 'none';
        otherSaveBtn.style.display = 'none';
        
        otherModuleForm.style.display = 'none';
        window.onload = function() {
            var service = document.querySelector("#_service").value;

            if (service == "") {
                addItemBtn.disabled = true;
            }
            saveBtn.disabled = true;
            otherSaveBtn.disabled = true;
            resetItemsFromStorage();
        }

        function selectModule() {
            // var moduleValue = moduleValue;
            var moduleApp = JSON.parse(moduleValue.value);
            var locationFrom = document.querySelector('#_locationForm');
            
            if (moduleApp.code !== "LCV") {
                locationFrom.style.display = 'none';
                otherModuleForm.style.display = 'block';

                locationDetails.style.display = 'none';
                otherDetails.style.display = 'block';
                otherSaveBtn.style.display = 'none';
                saveBtn.style.display = 'block';

            } else {
                locationFrom.style.display = 'block';
                otherModuleForm.style.display = 'none';

                locationDetails.style.display = 'block';
                otherDetails.style.display = 'none';

                otherSaveBtn.style.display = 'block';
                saveBtn.style.display = 'none';

            }
        }

        function selectArticle() {
            var article = document.querySelector("#_article").value;
            var price = document.querySelector("#_price");
            var quantity = document.querySelector("#_quantity");
            var priceText = document.querySelector('#_price_text');


            article = JSON.parse(article);
            price.value = article.unit_price;

            unitPrice = article.unit_price;
            quantity.value = 0;
            priceText.innerHTML = "$" + parseInt(0).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function calculOfPrice() {
            var article = document.querySelector('#_article').value;
            var quantity = document.querySelector("#_quantity").value;
            var priceText = document.querySelector('#_price_text');


            if (quantity > 0 && article !== "") {
                addItemBtn.disabled = false;
            } else {
                addItemBtn.disabled = true;
            }
            let total = unitPrice * quantity;

            priceText.innerHTML = "$" + total.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function setModulePrice() {
            var modulePriceText = document.querySelector('#_module_price_text');
            var modulePrice = document.querySelector('#_module_price');

            var price = parseFloat(modulePrice.value);

            if (isNaN(price)) {
                price = 0;
            } else {
                price = parseFloat(modulePrice.value).toFixed(2);
            }

            modulePriceText.innerHTML = "$" + price.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })
        }

        function addItem() {
            var moduleApp = JSON.parse(moduleValue.value);            
            var article = document.querySelector('#_article').value;
            var service = document.querySelector('#_service').value;
            var quantity = document.querySelector("#_quantity").value;
            var data = {
                article: JSON.parse(article),
                service: service,
                quantity: quantity,
                module_id: moduleApp.id,
                _token: "{{ csrf_token() }}"
            }

            $.ajax({
                url: "{{ route('articles.invoices.add.item') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log("Item added successfully");
                    addItemBtn.disabled = true;
                    showItems();
                }
            });
        }

        function addModuleItem() {
            var moduleValue = JSON.parse(document.querySelector('#_module').value);
            var price = document.querySelector('#_module_price').value;
            var serviceDetails = document.querySelector('#_service_details').value;

            console.log("service details . ", serviceDetails);
            
            var data = {   
                module: moduleValue,
                serviceDetails: serviceDetails,
                quantity: 1,  // Assuming all items are in one quantity for now. We can adjust this later.
                price: price,
                _token: "{{ csrf_token() }}"
            }

            $.ajax({
                url: "{{ route('invoices.add.module.item') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log("Module item added successfully");
                    addItemBtn.disabled = true;
                    showModuleItems();
                    // location.reload();
                }
            })
            console.log("price : " + price);

        }

        function getItemsFromStorage() {
            var items = localStorage.getItem('serviceItems');

            return items ? JSON.parse(items) : [];
        }

        function saveItemsToStorage(items) {
            localStorage.setItem('serviceItems', JSON.stringify(items));
        }

        function addItemToStorage(item) {
            var items = getItemsFromStorage();
            items = item;
            saveItemsToStorage(items);
        }

        function resetItemsFromStorage() {
            localStorage.setItem("serviceItems", []);
        }

        function showItems() {
            var invoicePriceText = document.querySelector('#_total_invoice_price_text')
            $.ajax({
                url: "{{ route('articles.invoices.get.items') }}",
                method: 'GET',
                success: function(response) {
                    var items = response.articles;
                    document.querySelector("#items-table tbody").innerHTML = "";

                    var article = document.querySelector("#_article");
                    var service = document.querySelector("#_service");
                    var price = document.querySelector("#_price");
                    var quantity = document.querySelector("#_quantity");
                    var priceText = document.querySelector('#_price_text');
                    var tableBody = document.querySelector("#items-table tbody");

                    var invoicePrice = 0;
                    var tr = "";
                    items.forEach((item, index) => {
                        tr += `<tr>`;
                        tr += `<td>${item.article.name}</td>`;
                        // tr += `<td>${item.article}</td>`;
                        tr += `<td>${item.article.unit_price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>`;
                        tr += `<td>${item.quantity}</td>`;
                        tr += `<td>${(parseInt(item.quantity) * parseInt(item.article.unit_price)).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>`;
                        tr += `<td>
                                    <button type="button" class="btn btn-light mt-0 remove-wishlist waves-effect waves-float waves-light" onclick="removeItem(${index})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x align-middle mr-25"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </td>`;
                        invoicePrice += parseInt(item.quantity) * parseInt(item.article.unit_price);
                    });

                    tableBody.innerHTML = tr;
                    // invoicePriceText.innerHTML = "$" + invoicePrice.toFixed(2);
                    article.value = "";
                    service.value = "";
                    price.value = "";
                    quantity.value = 0;
                    priceText.innerHTML = "$" + parseInt(0).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    invoicePriceText.innerHTML = "$" + invoicePrice.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    addItemToStorage(items);
                    activeSaveBtn();
                }
            });
        }

        function showModuleItems() {
            var invoicePriceText = document.querySelector('#_total_invoice_price_text');
            var tableBody = document.querySelector("#items-module-table tbody");
            var priceText = document.querySelector('#_price_text');

            $.ajax({
                url: "{{ route('modules.invoices.get.items') }}",
                method: 'GET',
                success: function(response) {
                    var items = response.modules;
                    document.querySelector("#items-table tbody").innerHTML = "";

                    var module = document.querySelector("#_module");

                    var invoicePrice = 0;
                    var tr = "";
                    items.forEach((item, index) => {
                        tr += `<tr>`;
                        tr += `<td>${item.module.name}</td>`;
                        tr += `<td>${item.serviceDetails}</td>`;
                        tr += `<td>${item.price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>`;
                        tr += `<td>
                                    <button type="button" class="btn btn-light mt-0 remove-wishlist waves-effect waves-float waves-light" onclick="removeModuleItem(${index})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x align-middle mr-25"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </td>`;
                        invoicePrice += parseInt(item.price);
                    });

                    tableBody.innerHTML = tr;
                    // invoicePriceText.innerHTML = "$" + invoicePrice.toFixed(2);

                    priceText.innerHTML = "$" + parseInt(0).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    invoicePriceText.innerHTML = "$" + invoicePrice.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    addItemToStorage(items);
                    activeSaveBtn();
                }
            });
        }

        function removeItem(index) {
            $.ajax({
                url: "{{ route('articles.invoices.remove.item') }}",
                method: 'POST',
                data: {
                    index: index,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log("Item removed successfully");
                    showItems();
                }
            })
        }

        function removeModuleItem(index) {
            $.ajax({
                url: "{{ route('modules.invoices.remove.item') }}",
                method: 'POST',
                data: {
                    index: index,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log("Item removed successfully");
                    showModuleItems();
                }
            })
        }

        function saveInvoice() {
            loadingBtn.style.display = 'block';
            saveBtn.style.display = 'none';
            var selectedClient = document.querySelector('#_selected_client').value;
            var creationDate = document.querySelector('#_creation_date').value;
            var dueDate = document.querySelector('#_due_date').value;
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            var isValid = false;

            if (dueDate.trim() === "") {
                isValid = false;
                errorAlert.style.display = "block";
                errorAlertMsg.innerHTML = "Veuillez renseigner la date d'échéance de la facture!";

                setInterval(function() {
                    errorAlert.style.display = 'none';
                }, 5000);
            } else if (creationDate.trim() === "") {
                isValid = false;
                errorAlert.style.display = "block";
                errorAlertMsg.innerHTML = "Veuillez renseigner la date de création de la facture!";

                setInterval(function() {
                    errorAlert.style.display = 'none';
                    loadingBtn.style.display = 'none';
                    saveBtn.style.display = 'block';
                }, 5000);
            } else if (selectedClient.trim() == '') {
                isValid = false;
                errorAlert.style.display = "block";
                errorAlertMsg.innerHTML = "Veuillez sélectionner un client!";

                setInterval(function() {
                    errorAlert.style.display = 'none';
                    loadingBtn.style.display = 'none';
                    saveBtn.style.display = 'block';
                }, 5000);
            } else {
                isValid = true;
            }


            var serviceItems = getItemsFromStorage();
            var moduleApp = JSON.parse(moduleValue.value);            
            
            if (isValid) {
                var data = {
                    issue_date: creationDate,
                    expiry_date: dueDate,
                    client_id: selectedClient,
                    items: serviceItems,
                    module_id: moduleApp.id,
                    _token: "{{ csrf_token() }}"
                }

                $.ajax({
                    url: "{{ route('articles.invoices.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        alert.style.display = 'block';
                        alertMsg.innerHTML = "Facture enregistrée avec succès!";
                        setInterval(function() {
                            alert.style.display = 'none';
                            saveBtn.style.display = 'block';
                            loadingBtn.style.display = 'none';
                        }, 5000);

                        document.querySelector('#_selected_client').value = "";
                        document.querySelector('#_creation_date').value = "";
                        document.querySelector('#_due_date').value = "";

                        resetItemsFromStorage();
                        showItems();
                    },
                    done: function() {
                        console.log("kendo eh bisa bango");
                        
                    }
                })
            }
        }

        function saveModuleInvoice() {
            loadingBtn.style.display = 'block';
            saveBtn.style.display = 'none';

            var selectedClient = document.querySelector('#_selected_client').value;
            var creationDate = document.querySelector('#_creation_date').value;
            var dueDate = document.querySelector('#_due_date').value;
            var alertMsg = document.querySelector("#_alert_msg");
            var errorAlertMsg = document.querySelector("#_error_alert_msg");

            var isValid = false;

            if (dueDate.trim() === "") {
                isValid = false;
                errorAlert.style.display = "block";
                errorAlertMsg.innerHTML = "Veuillez renseigner la date d'échéance de la facture!";

                setInterval(function() {
                    errorAlert.style.display = 'none';
                }, 5000);
            } else if (creationDate.trim() === "") {
                isValid = false;
                errorAlert.style.display = "block";
                errorAlertMsg.innerHTML = "Veuillez renseigner la date de création de la facture!";

                setInterval(function() {
                    errorAlert.style.display = 'none';
                    loadingBtn.style.display = 'none';
                    saveBtn.style.display = 'block';
                }, 5000);
            } else if (selectedClient.trim() == '') {
                isValid = false;
                errorAlert.style.display = "block";
                errorAlertMsg.innerHTML = "Veuillez sélectionner un client!";

                setInterval(function() {
                    errorAlert.style.display = 'none';
                    loadingBtn.style.display = 'none';
                    saveBtn.style.display = 'block';
                }, 5000);
            } else {
                isValid = true;
            }

            var moduleItems = getItemsFromStorage();

            if (isValid) {
                var data = {
                    issue_date: creationDate,
                    expiry_date: dueDate,
                    client_id: selectedClient,
                    items: moduleItems,
                    _token: "{{ csrf_token() }}"
                }

                $.ajax({
                    url: "{{ route('modules.invoices.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        alert.style.display = 'block';
                        alertMsg.innerHTML = "Facture enregistrée avec succès!";
                        setInterval(function() {
                            alert.style.display = 'none';
                            saveBtn.style.display = 'block';
                            loadingBtn.style.display = 'none';

                            document.querySelector('#_module').value = "";
                            document.querySelector('#_creation_date').value = "";
                            document.querySelector('#_due_date').value = "";
                            document.querySelector('#_service_details').value = "";
                            document.querySelector('#_module_price').value = "";
                            document.querySelector('#_selected_client').value = "";
                        }, 5000);

                        resetItemsFromStorage();
                        showModuleItems();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        saveBtn.style.display = 'block';
                        loadingBtn.style.display = 'none';
                    }
                })
            }
        }

        function resetForm() {
            var selectedClient = document.querySelector('#_selected_client');
            var creationDate = document.querySelector('#_creation_date');
            var dueDate = document.querySelector('#_due_date');
            var reference = document.querySelector('#_reference');

            selectedClient.value = "";
            creationDate.value = "";
            dueDate.value = "";
            reference.value = "";
        }

        function activeSaveBtn() {
            var selectedClient = document.querySelector('#_selected_client').value;
            var serviceItems = getItemsFromStorage();

            if (selectedClient !== "" && serviceItems.length > 0) {
                saveBtn.disabled = false;
                otherSaveBtn.disabled = false;
            } else {
                saveBtn.disabled = true;
                otherSaveBtn.disabled = true;
            }
        }
    </script>
</x-main>