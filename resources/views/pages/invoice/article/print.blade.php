<x-main>
    <div class="invoice-print p-5">
        <div class="d-flex justify-content-between">
            <div class="mt-5">
                <img src="{{ asset('app-assets/images/logo/logo.png') }}" width="200" alt="logo">
            </div>
            <div class="mt-md-0 mt-0">
                <h5 class="font-weight-bolder text-right mb-0">ELGRACE SERVICES SARL</h5>
                <p class="mb-0 text-right">RCCM:CD/LSH/RCCM/23-B-00779 <br>
                    <span class="text-right">NIF: A2317288S</span> <br>
                    <span class="text-right">ID NAT: 05-F4300-N05146Y </span> <br>
                    <span class="text-right">452, Rue 3, Q/Munua Golf plateau C/Annexe </span> <br>
                    <span class="text-right">+(243) 85 84 67 896</span> <br>
                    <span class="text-right">sales@elg-s.com</span> <br>
                    <span class="text-right">www.elg-s.com </span> <br>
                    <span class="text-right">Lubumbashi - Haut-Katanga - RDC </span>
                </p>

                <!-- <h4 class="font-weight-bold text-right mb-1">Facture : {{ $preInvoice->reference }}</h4>
                <div class="invoice-date-wrapper mb-50">
                    <span class="invoice-date-title">Date:</span>
                    <span class="font-weight-bold"> {{ date('d/m/Y', strtotime($preInvoice->issue_date))}}</span>
                </div>
                <div class="invoice-date-wrapper">
                    <p class="invoice-date-title">Date d'échéance:</p>
                    <p class="invoice-date">{{ date('d/m/Y', strtotime($preInvoice->expiry_date))}}</p>
                </div> -->
            </div>
        </div>

        <hr class="my-0" />

        <div class="row text-center mt-2 mb-2">
            <div class="col-md-4 offset-md-4">
                <h3><b>INVOICE N° {{ $preInvoice->reference }}</b></h3>
            </div>
        </div>
        <div class="row pb-2 mt-2">
            <div class="col-sm-4">
                <p class="mb-2"><span class="font-weight-bolder">Client : </span><br>
                    {{ $preInvoice->client['name'] }}
                </p>
            </div>
            <div class="col-sm-4">
                <p class="mb-2"><span class="font-weight-bolder">Livré à : </span><br>
                    {{ $preInvoice->client['name'] }} <br>
                    {{ $preInvoice->client['address'] }} <br>
                    {{ _('Lubumbashi')}}
                </p>
            </div>
            <div class="col-sm-4">
                <p class="mb-2"><span class="font-weight-bolder">Autres détails : </span><br>
                    {{ $preInvoice->client['phone'] }} <br>
                    {{ $preInvoice->client['email'] }}
                </p>
            </div>
            <div class="col-sm-6 mt-sm-0 mt-2">
                <!-- <h6 class="mb-1">Payment Details:</h6>
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

        <div class="table-responsive mt-2">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="py-1">N°</th>
                        <th class="py-1">Désignation</th>
                        <th class="py-1">Quantité</th>
                        <th class="py-1">Prix unitaire</th>
                        <!-- <th class="py-1">Prix unitaire</th> -->
                        <th class="py-1">Prix Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if($details)
                    @foreach($details as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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
        <hr class="my-2" />
        <div class="row invoice-sales-total-wrapper mt-0">
            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-0">
                <p class="card-text mb-0">
                    <!-- <span class="font-weight-bold">Salesperson:</span> <span class="ml-75">Alfie Solomons</span> -->
                </p>
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
                        <p class="invoice-total-title font-weight-bold">TOTAL:</p>
                        <p class="invoice-total-amount">${{ number_format($preInvoice->total_ttc, 2, '.', ',') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 col-sm-4">
                <h5>Date: ______________</h5>
            </div>
            <div class="col-md-4 col-sm-4 text-right">
                <h5>Received: ______________</h5>
            </div>
            <div class="col-md-4 col-sm-4 text-right">
                <h5>Signed: ______________</h5>
            </div>
            <!-- <table>
                <tbody>
                    <tr>
                        <td class="p-5">Date:________</td>
                        <td class="p-5">Received: _________________</td>
                        <td class="p-5">Signed:_________________</td>
                    </tr>
                </tbody>
            </table> -->
        </div>
        <div class="row mt-4">
            <div class="col-md-12 col-sm-12 justify-content-between">
                <p class="invoice-footer-text">
                    <h6 class="font-weight-bolder">TERMES ET CONDITIONS DE VENTE</h6>
                    <!-- <p> -->
                        <span style="font-size: 13px;">1. La livraison des matériels se fait 20 jours après la confirmation de la commande</span><br>
                        <span style="font-size: 13px;">2. La confirmation de la commande se fait par un paiement de 50% du montant total de la facture et le 50% restant seront payés à la livraison.</span><br>
                        <span style="font-size: 13px;">3. Si vous n'êtes pas d'accord avec la cotation proposée prière nous contacter directement</span><br>
                        <span style="font-size: 13px;">4. Le paiement peut se faire par virement bancaire (information bancaire en bas de la facture) ou directement en cash</span><br>
                        <span style="font-size: 13px;">5. La vérification de la conformité du matériels livrés se fait à la livraison</span><br>
                        <span style="font-size: 13px;">6. La garantie est fixée pour un delai de trois mois à partir de la date de livraison</span><br>
                    <!-- </p> -->
                </p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 text-center">
                <p class="invoice-footer-text">
                    <h6 class="font-weight-bolder">INFORMATION DE PAIEMENT</h6>
                    <p>
                        <span style="font-size: 13px;">RAWBANK: 00924010001-41 USD</span><br>
                        <span style="font-size: 13px;">EQUITY BCDC : 160121300120095-USD</span><br>
                    </p>
                </p>
            </div>
        </div>
    </div>
</x-main>