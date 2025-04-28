@extends('tache.app')
@section('content')
    <h2> Page D'accueil</h2>
    <a href="{{route('tache.create')}}" class="btn btn-info">Ajouter Tache</a>
    <a href="{{route('logout')}}" class="btn btn-info ml-3">Deconnexion</a>

    <table class="table">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tache as $taches)
        <tr class="table-active">
            <td>{{$taches->titre}}</td>
            <td>{{$taches->description}}</td>
            <td>
                <a href="{{route('tache.edit',$taches->id)}}" class="btn btn-info">Modifier</a>
                <form action="{{route('tache.destroy',$taches->id)}}" method="post" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('voulez-vous vraiment le suprimer')" class="btn btn-danger">SUPRIMER</button>

                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
