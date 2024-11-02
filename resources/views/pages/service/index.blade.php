<x-main>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des services</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-task-modal">
                        Nouveau service
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix unitaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($services)
                            @foreach ($services as $service)
                            <tr>
                                <td>
                                    <!-- <img src="../../../app-assets/images/icons/angular.svg" class="mr-75" height="20" width="20" alt="Angular" /> -->
                                    <span class="font-weight-bold">{{ $service->name }}</span>
                                </td>
                                <td>{{ $service->description }}</td>
                                <td>
                                    {{ $service->price }} $
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
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
        </div>
    </div>

    <!-- Right Sidebar starts -->
    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <form id="form-modal-todo" class="todo-modal needs-validation">
                    <div class="modal-header align-items-center mb-1">
                        <h5 class="modal-title">Ajout d'un nouveau service</h5>
                        <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                            <span class="todo-item-favorite cursor-pointer mr-75"><i data-feather="star" class="font-medium-2"></i></span>
                            <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal" aria-label="Close">
                                ×
                            </button>
                        </div>
                    </div>

                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert_success">
                                    <div class="alert-body">
                                        L'enregistrement du nouveau service a réussi avec succès!
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_service_name">Nom du service</label>
                                    <input type="text" id="_service_name" class="form-control" name="name" placeholder="ex: Table de bureau" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_description">Description </label>
                                    <textarea class="form-control" id="_description" name="description" rows="3" placeholder="Une petite description de l'article au besoin"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_unit_price">Prix unitaire</label>
                                    <input type="number" id="_unit_price" class="form-control" name="unit_price" placeholder="Ex: 100" />
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 mt-2">
                                <button class="btn btn-outline-primary" type="button" id="_loading_btn" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <span class="sr-only">Loading...</span>
                                </button>
                                <button type="submit" onclick="onSubmit()" id="_saving_btn" class="btn btn-primary mr-1">Enregistrer</button>
                                <button type="reset" id="_reset_btn" class="btn btn-outline-secondary">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Right Sidebar ends -->
    <script>
        const loadingBtn = document.querySelector('#_loading_btn');
        const savingBtn = document.querySelector('#_saving_btn');
        const resetBtn = document.querySelector('#_reset_btn');
        const alertSuccess = document.querySelector('#alert_success');

        window.onload = function() {
            loadingBtn.style.display = 'none';
            alertSuccess.style.display = 'none';
        }

        function onSubmit() {
            loadingBtn.style.display = 'block';
            savingBtn.style.display = 'none';
            resetBtn.style.display = 'none';

            const serviceName = document.getElementById('_service_name').value;
            const description = document.getElementById('_description').value;
            const unitPrice = document.getElementById('_unit_price').value;

            const data = {
                name: serviceName,
                description: description,
                price: unitPrice,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('services.store') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log("Success : ", response);
                    alertSuccess.style.display = 'block';

                    setInterval(function() {
                        alertSuccess.style.display = 'none';
                        loadingBtn.style.display = 'none';
                        location.reload();
                    }, 5000);

                    document.getElementById('_service_name').value = "";
                    document.getElementById('_description').value = "";
                    document.getElementById('_unit_price').value = "";
                },
                error: function(error) {
                    console.error("Error occured : ", error);
                    loadingBtn.style.display = 'none';
                    savingBtn.style.display = 'block';
                    resetBtn.style.display = 'block';
                }
            });
            console.log("onSubmit : ", serviceName);

        }
    </script>
</x-main>