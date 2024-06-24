@extends('layouts.admin')

@section('content')
    <h1>Crea un nuovo progetto</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.project.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="5">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="type_id">Tipo</label>
            <select class="form-select" name="type_id" id="type_id">
                <option value="">Seleziona</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->project_type}}</option>
                    @endforeach                
            </select>
            
        </div>        
        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
@endsection
