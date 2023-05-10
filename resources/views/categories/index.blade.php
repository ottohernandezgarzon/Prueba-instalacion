@extends('app')


@section('content')
    <div class="container w-25 border p-4 mt-4">
        <div class="row mx-auto">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
                @error('name' || 'color')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Crear Categoría</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" name="color" class="form-control" color="color" id="color">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Crear Nueva Categoria</button>
            </form>
            <div>
                @foreach ($categories as $category)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('categories.show', ['category' => $category->id]) }}"
                                class="d-flex align-items-center gap2">
                                <span class="color-container"
                                    style="background-color:{{ $category->color }}"></span>{{ $category->name }}
                            </a>
                        </div>
                        <div class="col-md-3 d-flex align-content-end">
                            <!--  Modal trigger button  -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $category->id }}">
                                Eliniar
                            </button>

                        </div>

                    </div>

                    <!-- Modal Body-->
                    <div class="modal fade" id="modal-{{ $category->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">Eliminarás {{ $category->name }} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        ¿Quiere Eleminar la Categoría {{ $category->name }}?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
