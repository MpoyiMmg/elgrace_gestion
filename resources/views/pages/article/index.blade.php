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
                    <h4 class="card-title">Liste des articles</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-task-modal">
                        Nouvel article
                    </button>
                </div>
                <div class="table-responsive">
                    @if (count($articles))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Intitulé</th>
                                <th>Description</th>
                                <th>Prix unitaire</th>
                                <th>Quantité disponible</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($articles)
                            @foreach ($articles as $article)
                            <tr>
                                <td>
                                    <!-- <img src="../../../app-assets/images/icons/angular.svg" class="mr-75" height="20" width="20" alt="Angular" /> -->
                                    <span class="font-weight-bold">{{ $article->name }}</span>
                                </td>
                                <td>{{ $article->description }}</td>
                                <td>
                                    {{ $article->unit_price }} 
                                </td>
                                <td>
                                    {{ $article->quantity }} 
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('articles.edit', $article->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Editer</span>
                                            </a>
                                            
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
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
                            @endif
                        </tbody>
                    </table>
                    @else
                    <tr>
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5 mb-4">
                            <img class="img-fluid" src="{{ asset('app-assets/images/pages/error.svg') }}"  alt="Empty data" />
                        </div>
                        <div class="d-lg-flex align-items-center justify-content-center mb-4">
                            <h3>Aucun article n'a été trouvé, veuillez en ajouter!</h3>
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
                        <h5 class="modal-title">Ajout d'un article</h5>
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
                                        L'enregistrement d'un nouvel article a réussi avec succès!
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
                                    <label for="_article_name">Nom de l'article</label>
                                    <input type="text" id="_article_name" class="form-control" name="name" placeholder="ex: Table de bureau" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_description">Description </label>
                                    <textarea class="form-control" id="_description" name="description" rows="1" placeholder="Une petite description de l'article au besoin"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_price">Prix unitaire</label>
                                    <input type="number" id="_price" class="form-control" name="unit_price" placeholder="Ex: 100" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="_quantity">Quantité en stock</label>
                                    <div class="demo-inline-spacing">
                                        <div class="input-group input-group-lg">
                                            <input type="number" class="touchspin" value="0" name="stock" id="_quantity" />
                                        </div>
                                    </div>
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

            const articleName = document.getElementById('_article_name').value;
            const description = document.getElementById('_description').value;
            const price = document.getElementById('_price').value;
            const quantity = document.getElementById('_quantity').value;

            console.log("description : ", description === "");
            
            const data = {
                name: articleName,
                description: description,
                unit_price: price,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('articles.store') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    alertSuccess.style.display = 'block';

                    setInterval(function() {
                        alertSuccess.style.display = 'none';
                        loadingBtn.style.display = 'none';
                        location.reload();
                    }, 5000);

                    document.getElementById('_article_name').value = "";
                    document.getElementById('_description').value = "";
                    document.getElementById('_price').value = "";
                    document.getElementById('_quantity').value = "";
                    
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