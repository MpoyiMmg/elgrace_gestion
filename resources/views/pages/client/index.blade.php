<x-main>
    @if (session('success'))
    <div class="col-lg-8 offset-lg-2 col-sm-12">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if ($errors->any())
    <div class="col-lg-8 offset-lg-2 col-sm-12">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des clients</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-task-modal">
                        Nouveau client
                    </button>
                </div>
                <div class="table-responsive">
                    @if (count($clients))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Personne à contacter</th>
                                <th>Adresse mail</th>
                                <th>Téléphone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($clients)
                            @foreach ($clients as $client)
                            <tr>
                                <td>
                                    <!-- <img src="../../../app-assets/images/icons/angular.svg" class="mr-75" height="20" width="20" alt="Angular" /> -->
                                    <span class="font-weight-bold">{{ $client->name }}</span>
                                </td>
                                <td>{{ $client->address }}</td>
                                <td>
                                    {{ $client->contact }}
                                </td>
                                <td>
                                    {{ $client->email }}
                                </td>
                                <td>
                                    {{ $client->phone }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Éditer</span>
                                            </a>
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" 
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="dropdown-item text-danger">
                                                  <i data-feather="trash" class="mr-50"></i>
                                                  <span>Supprimer</span>
                                              </button>
                                          </form>
                                          
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    @else
                    <tr>
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5 mb-4">
                            <img class="img-fluid" src="{{ asset('app-assets/images/pages/error.svg') }}" alt="Empty data" />
                        </div>
                        <div class="d-lg-flex align-items-center justify-content-center mb-4">
                            <h3>Aucun client n'a été trouvé, veuillez en ajouter!</h3>
                        </div>
                    </tr>
                    @endif
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
                        <h5 class="modal-title">Ajout d'un nouveau client</h5>
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
                                        L'enregistrement du nouveau client a réussi avec succès!
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
                                    <label for="_client_name">Nom du client</label>
                                    <input type="text" id="_client_name" class="form-control" name="name" placeholder="ex: Table de bureau" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_address">Adresse physique </label>
                                    <textarea class="form-control" id="_address" name="address" rows="1" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_contact">Contact</label>
                                    <input type="text" id="_contact" class="form-control" name="contact" placeholder="" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_phone">Téléphone</label>
                                    <input type="number" id="_phone" class="form-control" name="phone" placeholder="Ex: 0999999999" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_email">Adresse mail</label>
                                    <input type="text" id="_email" class="form-control" name="email" placeholder="" />
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 mt-2">
                                <button class="btn btn-outline-primary" type="button" id="_loading_btn" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <span class="sr-only">Loading...</span>
                                </button>
                                <button onclick="onSave()" id="_saving_btn" class="btn btn-primary mr-1">Enregistrer</button>
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

        function onSave() {
            loadingBtn.style.display = 'block';
            savingBtn.style.display = 'none';
            resetBtn.style.display = 'none';

            const clientName = document.getElementById('_client_name').value;
            const address = document.getElementById('_address').value;
            const contact = document.getElementById('_contact').value;
            const phone = document.getElementById('_phone').value;
            const email = document.getElementById('_email').value;

            const data = {
                name: clientName,
                address: address,
                contact: contact,
                phone: phone,
                email: email,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('clients.store') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    alertSuccess.style.display = 'block';

                    setInterval(function() {
                        alertSuccess.style.display = 'none';
                        loadingBtn.style.display = 'none';
                        location.reload();
                    }, 5000);

                    document.getElementById('_client_name').value = "";
                    document.getElementById('_address').value = "";
                    document.getElementById('_contact').value = "";
                    document.getElementById('_phone').value = "";
                    document.getElementById('_email').value = "";
                },
                error: function(error) {
                    console.error("Error occured : ", error);
                    loadingBtn.style.display = 'none';
                    savingBtn.style.display = 'block';
                    resetBtn.style.display = 'block';
                }
            });
        }
    </script>
</x-main>