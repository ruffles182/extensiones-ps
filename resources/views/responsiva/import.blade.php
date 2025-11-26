@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Importar CSV y generar Responsivas</h2>

    <form action="{{ route('responsivas.import.procesar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Tipo de equipo</label>
            <select name="tipo_equipo_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($tipos as $t)
                    <option value="{{ $t->id }}">{{ $t->tipo_equipo }} - {{ $t->modelo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Archivo CSV</label>
            <input type="file" name="csv" accept=".csv" class="form-control" required>
        </div>

        <button class="btn btn-primary">Generar ZIP</button>
    </form>

</div>
@endsection
