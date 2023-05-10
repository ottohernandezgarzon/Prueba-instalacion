@extends('app')


@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('todos-store') }}" method="POST">
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }} </h6>
            @endif
            @error('title' || 'category_id')
                <h6 class="alert alert-danger">{{ $message }} </h6>
            @enderror
            <div class="col">
                <div class="mb-3">
                    <label for="title" class="form-label">Titulo de la Tarea</label>
                    <input type="text" name="title" id="title" class="form-control" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Ctaegorías</label>
                    <select class="form-select form-select-lg" name="category_id" id="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Crear Nueva Tarea</button>
        </form>
        <div>

            @foreach ($todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('todos-show', ['id' => $todo->id]) }}">{{ $todo->title }} </a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('destroy', ['id' => $todo->id]) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
