@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la recette</h1>
    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ $recipe->titre }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $recipe->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="duree">Durée (en minutes)</label>
            <input type="number" name="duree" class="form-control" value="{{ $recipe->duree }}" required>
        </div>
        <div class="form-group">
            <label for="difficulte">Difficulté</label>
            <select name="difficulte" class="form-control" required>
                <option value="Facile" {{ $recipe->difficulte == 'Facile' ? 'selected' : '' }}>Facile</option>
                <option value="Moyen" {{ $recipe->difficulte == 'Moyen' ? 'selected' : '' }}>Moyen</option>
                <option value="Difficile" {{ $recipe->difficulte == 'Difficile' ? 'selected' : '' }}>Difficile</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value = "{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ingredients">Ingrédients</label>
            <div id="ingredients-container">
                @foreach ($recipe->ingredients as $ingredient)
                <div class="ingredient
                -group mb-2">
                    <input type="text" name="ingredients[{{ $loop->index }}][nom]" class="form-control" value="{{ $ingredient->nom }}" placeholder="Nom de l'ingrédient" required>
                    <input type="text" name="ingredients[{{ $loop->index }}][quantite]" class="form-control" value="{{ $ingredient->pivot->quantite }}" placeholder="Quantité" required>
                </div>
                @endforeach
            </div>
            <button type="button" id="add-ingredient" class="btn btn-secondary">Ajouter un ingrédient</button>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<script>
    document.getElementById('add-ingredient').addEventListener('click', function () {
        const container = document.getElementById('ingredients-container');
        const index = container.children.length;
        const newIngredient = `
            <div class="ingredient-group mb-2">
                <input type="text" name="ingredients[${index}][nom]" class="form-control" placeholder="Nom de l'ingrédient" required>
                <input type="text" name="ingredients[${index}][quantite]" class="form-control" placeholder="Quantité" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newIngredient);
    });
</script>
@endsection