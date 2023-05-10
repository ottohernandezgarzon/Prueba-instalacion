@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <div class="row mx-auto">
            {{-- @foreach ($categories as $category) --}}
            <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
                @error('name' || 'color')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Actualizar Categoría</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $category->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" name="color" class="form-control" color="color" id="color"
                            value="{{ $category->color }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
            </form>
            {{-- @endforeach --}}
            <div class="">
                @if ($category->todos->count() > 0)
                    @foreach ($category->todos as $todo)
                        <div class="row py-1">
                            <div class="col-md-9 d-flex align-items-center">
                                <a href="{{ route('todos-show', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end">
                            <form action="{{ route('destroy', [$todo->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>No Hay Tareas Para Esta Categoría</p>
                @endif
            </div>
        </div>
    </div>
@endsection
