<x-main>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="alert-body">
            {{ session('success') }}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <section id="edit-service">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier le service</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('services.update', $service->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nom du service</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $service->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description" required>{{ old('description', $service->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" id="price" class="form-control" name="price" value="{{ old('price', $service->price) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>
