<x-main>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier un Utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="name">Nom</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $user->name) }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="role_id">Rôle</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="role_id" name="role_id" required>
                                                <option  selected disabled>Sélectionner un rôle</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" 
                                                        {{ old('role_id', $user->roles->first()->id ?? '') == $role->id ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary mr-1">Mettre à jour</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>
