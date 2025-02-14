<x-main>
    <section id="edit-client">
            @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier le client</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('clients.update', $client->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ $client->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{ $client->address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" id="contact" class="form-control" name="contact" value="{{ $client->contact }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Numéro de téléphone</label>
                                <input type="text" id="phone" class="form-control" name="phone" value="{{ $client->phone }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ $client->email }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>
