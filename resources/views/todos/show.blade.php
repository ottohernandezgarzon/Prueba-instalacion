@extends('app')


@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('todos-update', ['id' => $todo->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }} </h6>
            @endif
            @error('title')
                <h6 class="alert alert-danger">{{ $message }} </h6>
            @enderror
            <div class="col">
                <div class="mb-3">
                    <label for="title" class="form-label">Titulo de la Tarea</label>
                    <input type="text" name="title" id="title" class="form-control" aria-describedby="helpId"
                        value="{{ $todo->title }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
        </form>
    </div>
@endsection
