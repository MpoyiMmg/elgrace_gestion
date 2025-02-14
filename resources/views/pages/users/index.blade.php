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
                    <h4 class="card-title">Liste des utilisateurs</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-task-modal">
                        Nouvel utilisateur
                    </button>
                </div>
                <div class="table-responsive">
                    @if (count($users))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Adresse mail</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td><span class="font-weight-bold">{{ $user->name }}</span></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->isEmpty() ? 'Aucun rôle' : $user->roles->first()->name }}</td> <!-- Correction ici -->
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Éditer</span>
                                            </a>                                            
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Supprimer</span>
                                                </button>
                                            </form>               
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center">
                        <img class="img-fluid" src="{{ asset('app-assets/images/pages/error.svg') }}" alt="Empty data" />
                        <h3>Aucun utilisateur trouvé, veuillez en ajouter!</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Utilisateur -->
    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <form id="form-modal-user" class="needs-validation">
                    <div class="modal-header align-items-center mb-1">
                        <h5 class="modal-title">Ajout d'un nouvel utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>

                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_user_name">Nom</label>
                                    <input type="text" id="_user_name" class="form-control" name="name" placeholder="Nom" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_email">Email</label>
                                    <input type="email" id="_email" class="form-control" name="email" placeholder="Email" required />
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary" type="button" id="_saving_btn" onclick="onSave()">Enregistrer</button>
                                <button type="reset" id="_reset_btn" class="btn btn-outline-secondary">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        
        function onSave() {
            const name = document.getElementById('_user_name').value;
            const email = document.getElementById('_email').value;
           

            const data = {
                name: name,
                email: email,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('users.store') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    alert('Utilisateur ajouté avec succès');
                    location.reload();
                },
                error: function(error) {
                    alert('Une erreur est survenue');
                    console.error("Error :", error);
                }
            });
        }
    </script>
</x-main>
