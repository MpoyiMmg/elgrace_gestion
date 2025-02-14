<x-main>
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Créer un Utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="name">Nom</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" class="form-control" name="name" placeholder="Nom" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="role_id">Rôle</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select id="role_id" name="role_id" class="form-control" required>
                                                <option value="">-- Sélectionnez un rôle --</option>
                                                @foreach(App\Models\Role::all() as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary mr-1">Créer</button>
                                    <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>
