@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Recettes</h1>
    <a href="{{ route('recipes.create') }}" class="btn btn-primary">Ajouter une recette</a>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Difficulté</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipes as $recipe)
            <tr>
                <td>{{ $recipe->titre }}</td>
                <td>{{ $recipe->description }}</td>
                <td>{{ $recipe->duree }} minutes</td>
                <td>{{ $recipe->difficulte }}</td>
                <td>{{ $recipe->category->nom }}</td>
                <td>
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection