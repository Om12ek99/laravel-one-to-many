@extends('layouts.admin')

@section('content')
    <h1>Progetti</h1>

    <a href="{{ route('admin.project.create') }}" class="btn btn-primary mb-3">Crea nuovo progetto</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>    
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Tipo</th>
                <th>Slug</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $curProject)
                <tr>
                    <td>{{ $curProject->id }}</td>
                    <td>{{ $curProject->title }}</td>
                    <td>{{ $curProject->type?->project_type}}</td>
                    <td>{{ $curProject->slug }}</td>
                    <td>            
                        {{-- link per lo show        < --}}
                        <a href="{{ route('admin.project.show',['newProject'=>$curProject->slug])}}" class="btn btn-info">Mostra</a>

                        {{-- link per il destroy --}}
                        {{-- nell'action alla chiamata di destroy, si prende come riferimento lo slug e non l'id, perche nella rotta la abbiamo definita cosi --}}
                        <form action="{{ route('admin.project.destroy', ['newProject'=>$curProject->slug]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
