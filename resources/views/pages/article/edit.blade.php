<x-main>
    <section id="edit-article">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier l'article</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('articles.update', $article->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nom de l'article</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $article->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description">{{ old('description', $article->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="unit_price">Prix unitaire</label>
                                <input type="number" id="unit_price" class="form-control" name="unit_price" value="{{ old('unit_price', $article->unit_price) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantité</label>
                                <input type="number" id="quantity" class="form-control" name="quantity" value="{{ old('quantity', $article->quantity) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>
