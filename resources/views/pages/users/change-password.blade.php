<x-main>
    <section id="change-password">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Changer le mot de passe</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf
                            @method('PUT') <!-- Spoofing de la méthode PUT -->
                            <div class="form-group">
                                <label for="current_password">Mot de passe actuel</label>
                                <input type="password" id="current_password" class="form-control" name="current_password" required>
                                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password">Nouveau mot de passe</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" required>
                                @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                                <input type="password" id="new_password_confirmation" class="form-control" name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>
