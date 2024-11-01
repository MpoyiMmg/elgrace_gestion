<x-main>
    <section class="invoice-add-wrapper">
        <div class="row invoice-add">
            <!-- Invoice Add Left starts -->
            <div class="col-xl-9 col-md-8 col-12">
                <div class="card invoice-preview-card">
                    <!-- Header starts -->
                    <div class="card-body invoice-padding pb-0">
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                <div class="logo-wrapper">
                                    <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                        <defs>
                                            <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                                <stop stop-color="#000000" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </linearGradient>
                                            <linearGradient id="invoice-linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-400.000000, -178.000000)">
                                                <g transform="translate(400.000000, 178.000000)">
                                                    <path class="text-primary" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                    <path d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                    <polygon fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                    <polygon fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                    <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <h3 class="text-primary invoice-logo">Elgrace</h3>
                                </div>
                                <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                            <div class="invoice-number-date mt-md-0 mt-2">
                                <div class="d-flex align-items-center justify-content-md-end mb-1">
                                    <h4 class="invoice-title">Facture</h4>
                                    <div class="input-group input-group-merge invoice-edit-input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i data-feather="hash"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control invoice-edit-input" placeholder="53634" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <span class="title">Date:</span>
                                    <input type="date" class="form-control invoice-edit-input date-picker" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="title">Due Date:</span>
                                    <input type="date" class="form-control invoice-edit-input due-date-picker" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->

                    <hr class="invoice-spacing" />

                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row row-bill-to invoice-spacing">
                            <div class="col-xl-8 mb-lg-1 col-bill-to pl-0">
                                <h6 class="invoice-to-title">Facturé à :</h6>
                                <div class="invoice-customer">
                                    <select class="invoiceto form-control">
                                        <option value="" disabled selected> Veuillez séléctionner un client</option>
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                    </div>
                    <!-- Address and Contact ends -->

                    <!-- Product Details starts -->
                    <div class="card-body invoice-padding invoice-product-details">
                        <form class="source-item">
                            <div data-repeater-list="group-a">
                                <div class="repeater-wrapper" data-repeater-item>
                                    <div class="row">
                                        <div class="col-12 d-flex product-details-border position-relative pr-0">
                                            <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                    <p class="card-text col-title mb-md-50 mb-0">Service</p>
                                                    <select class="form-control item-details" id="_service" onchange="selectService()">
                                                        <option value="" selected disabled>Selectionner un service</option>
                                                        @foreach($services as $service)
                                                        <option value="{{ $service }}">{{ $service->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <textarea class="form-control mt-2" rows="1">Customization & Bug Fixes</textarea> -->
                                                </div>
                                                <div class="col-lg-3 col-12 my-lg-0 my-2">
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
                                    <button type="button" class="btn btn-primary btn-sm btn-add-new" onclick="addItem()">
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span class="align-middle">Add Item</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Product Details ends -->
                    <div class="table-responsive">
                        <table class="table" id="items-table">
                            <thead>
                                <tr>
                                    <th class="py-1">Service</th>
                                    <th class="py-1">Prix unitaire</th>
                                    <th class="py-1">Quantité</th>
                                    <th class="py-1">Total</th>
                                    <th class="py-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                                        <p class="invoice-total-amount">$1690</p>
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
                                    <label for="note" class="form-label font-weight-bold">Note:</label>
                                    <textarea class="form-control" rows="2" id="note">
                                        It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea>
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
                        <button class="btn btn-primary btn-block mb-75" disabled>Send Invoice</button>
                        <a href="./app-invoice-preview.html" class="btn btn-outline-primary btn-block mb-75">Preview</a>
                        <button type="button" class="btn btn-outline-primary btn-block">Save</button>
                    </div>
                </div>
            </div>
            <!-- Invoice Add Right ends -->
        </div>
    </section>
    <script>
        let unitPrice = 0;

        function selectService() {
            var service = document.querySelector("#_service").value;
            var price = document.querySelector("#_price");

            service = JSON.parse(service);
            price.value = service.price;

            unitPrice = service.price;
            // console.log("service: ", JSON.parse(service));

            // document.getElementById("service-price").value = service === "Service 1"? 100 : service === "Service 2"? 200 : 300;
        }

        function calculOfPrice() {
            var quantity = document.querySelector("#_quantity").value;
            var priceText = document.querySelector('#_price_text');

            let total = unitPrice * quantity;

            priceText.innerHTML = "$" + total.toFixed(2);
            console.log("price : ", total.toFixed(2));

            // var price = document.querySelector("#_price");
            // var quantity = document.querySelector("#_quantity").value;
            // // var discount = document.querySelector("#_discount").value;
            // var totalPrice = price.value * quantity * (1 - discount/100);
            // document.getElementById("total-price").value = totalPrice;
        }

        function addItem() {
            var service = document.querySelector('#_service').value;
            var quantity = document.querySelector("#_quantity").value;
            var data = {
                service: JSON.parse(service),
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            }

            $.ajax({
                url: "{{ route('invoices.add.item') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log("Item added successfully");
                    showItems();
                    // location.reload();
                }
            });
        }

        function showItems() {
            $.ajax({
                url: "{{ route('invoices.get.items') }}",
                method: 'GET',
                success: function(response) {
                    console.log("Items fetched successfully : ", response);
                    var items = response.items;
                    document.querySelector("#items-table tbody").innerHTML = "";

                    var tableBody = document.querySelector("#items-table tbody");
                    var tr = "";
                    items.forEach((item, index) => {
                        // var row = document.createElement("tr");
                        // var serviceCell = document.createElement("td");
                        // var quantityCell = document.createElement("td");
                        // var priceCell = document.createElement("td");
                        // var totalCell = document.createElement("td");

                        tr += "<tr>";
                        tr += "<td>${item.service.name}</td>";
                        tr += "<td>${item.service.price}</td>";
                        tr += "<td>${item.quantity}</td>";
                        tr += "<td>${parseInt(item.quantity) * parseInt(item.service.price)}</td>";
                        tr += `<td>
                                    <button type="button" class="btn btn-light mt-1 remove-wishlist waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x align-middle mr-25"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        <span>Remove</span>
                                    </button>"
                                </td>`;
                        tr += "</tr>";
                        // serviceCell.innerHTML = item.service.name;
                        // priceCell.innerHTML = "$" + parseInt(item.service.price).toFixed(2);
                        // quantityCell.innerHTML = item.quantity;
                        // totalCell.innerHTML = "$" + (parseInt(item.quantity) * parseInt(item.service.price)).toFixed(2);

                        // row.appendChild(serviceCell);
                        // row.appendChild(priceCell);
                        // row.appendChild(quantityCell);
                        // row.appendChild(totalCell);

                        // tableBody.appendChild(row);
                    });
                    tableBody.innerHTML = tr;
                }
            });
        }
    </script>
</x-main>