<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos      = Todo::all();
        $categories = Category::all();
        return view( 'todos.index', [ 
            'todos'      => $todos,
            'categories' => $categories
        ] );
    }
    public function store( Request $request )
    {
        $request->validate( [ 
            'title' => 'required|min:3'
        ] );
        $todo              = new Todo;
        $todo->title       = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route( 'todos' )->with( 'success', 'Tarea Creada' );
    }
    public function show( $id )
    {
        $todo = Todo::find( $id );
        return view( 'todos.show', [ 'todo' => $todo ] );
    }
    public function update( Request $request, $id )
    {
        $todo              = Todo::find( $id );
        $todo->title       = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        return redirect()->route( 'todos' )->with( 'success', 'Tarea Actualizada' );
    }
    public function destroy( $id )
    {
        $todo = Todo::find( $id );
        $todo->deleted();
        return redirect()->route( 'todos' )->with( 'success', 'Tarea Eliminada' );
    }
}