@extends('tache.app')
@section('content')
    <h2>@if(!empty($tache)) Modification @else Creation @endif D'une Tache</h2>
    <form action="{{ empty($tache) ? route('tache.store') : route('tache.update', $tache->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(!empty($tache))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" @if(!empty($tache)) value="{{ old('titre', $tache->titre) }}" @endif name="titre" id="titre">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description">{{ !empty($tache) ? old('description', $tache->description) : "" }}</textarea>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">

            @if(!empty($tache) && $tache->photo)
                <div style="margin-top:10px;">
                    <img src="{{ asset('storage/' . $tache->photo) }}" alt="Photo actuelle" width="150">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            @if(!empty($tache)) Modifier @else Ajouter @endif
        </button>
    </form>
@endsection
