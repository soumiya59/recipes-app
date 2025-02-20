@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une recette</h1>
    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="duree">Durée (en minutes)</label>
            <input type="number" name="duree" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="difficulte">Difficulté</label>
            <select name="difficulte" class="form-control" required>
                <option value="Facile">Facile</option>
                <option value="Moyen">Moyen</option>
                <option value="Difficile">Difficile</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ingredients">Ingrédients</label>
            <div id="ingredients-container">
                <div class="ingredient-group mb-2">
                    <input type="text" name="ingredients[0][nom]" class="form-control" placeholder="Nom de l'ingrédient" required>
                    <input type="text" name="ingredients[0][quantite]" class="form-control" placeholder="Quantité" required>
                </div>
            </div>
            <button type="button" id="add-ingredient" class="btn btn-secondary">Ajouter un ingrédient</button>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
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