@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rechercher des recettes</h1>
    <form action="{{ route('recipes.search') }}" method="GET">
        <div class="form-group">
            <input type="text" name="query" class="form-control" placeholder="Rechercher par titre..." value="{{ request('query') }}">
        </div>
        <div class="form-group">
            <select name="category_id" class="form-control">
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nom }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="ingredient_id" class="form-control">
                <option value="">Tous les ingrédients</option>
                @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}" {{ request('ingredient_id') == $ingredient->id ? 'selected' : '' }}>
                    {{ $ingredient->nom }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <hr>

    @if ($recipes->isEmpty())
        <p>Aucune recette trouvée.</p>
    @else
        <div class="row">
            @foreach ($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->titre }}</h5>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">Voir la recette</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $recipes->links() }}
    @endif
</div>
@endsection