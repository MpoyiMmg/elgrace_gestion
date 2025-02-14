<x-main>
    <section id="dashboard-analytics">
        <div class="row match-height">
            <!-- Greetings Card starts -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img src="../../../app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                        <img src="../../../app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Bonjour {{ $user->name }},</h1>
                            <p class="card-text m-auto w-75">
                                Bienvenue sur le tableau de board
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Greetings Card ends -->

            <!-- Subscribers Chart Card starts -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="users" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">15</h2>
                        <p class="card-text">Factures payées</p>
                    </div>
                    <div id="gained-chart"></div>
                </div>
            </div>
            <!-- Subscribers Chart Card ends -->

            <!-- Orders Chart Card starts -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="package" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">10</h2>
                        <p class="card-text">En attente de validation</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>
            <!-- Orders Chart Card ends -->
        </div>

        <div class="row match-height">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="package" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">10</h2>
                        <p class="card-text">En attente de validation</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="package" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">10</h2>
                        <p class="card-text">En attente de validation</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="package" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">10</h2>
                        <p class="card-text">En attente de validation</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>
        </div>

        <!-- List DataTable -->
        <!-- <div class="row">
            <div class="col-12">
                <div class="card invoice-list-wrapper">
                    <div class="card-datatable table-responsive">
                        <table class="invoice-list-table table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th><i data-feather="trending-up"></i></th>
                                    <th>Client</th>
                                    <th>Total</th>
                                    <th class="text-truncate">Issued Date</th>
                                    <th>Balance</th>
                                    <th>Invoice Status</th>
                                    <th class="cell-fit">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!--/ List DataTable -->
    </section>
    <!-- Kick start -->
    <!--/ Page layout -->
</x-main>