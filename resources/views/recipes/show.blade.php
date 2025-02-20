@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $recipe->titre }}</h1>
    <p>{{ $recipe->description }}</p>
    <p>Durée : {{ $recipe->duree }} minutes</p>
    <p>Difficulté : {{ $recipe->difficulte }}</p>
    <p>Catégorie : {{ $recipe->category->nom }}</p>

    <h2>Ingrédients</h2>
    <ul>
        @foreach ($recipe->ingredients as $ingredient)
        <li>{{ $ingredient->nom }} ({{ $ingredient->pivot->quantite }})</li>
        @endforeach
    </ul>
    

    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>
@endsection