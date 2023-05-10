<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view( 'categories.index', [ 'categories' => $categories ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function create()
    {
    //
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $request->validate( [ 
            'name'  => 'required|unique:categories|max:255',
            'color' => 'required|min:7'
        ] );
        $category        = new Category;
        $category->name  = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route( 'categories.index' )->with( 'success', 'Nueva Categoría Creada' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        /*    $Categories = Category::find( $category );
        foreach ( $Categories as $category )
        {
        return view( 'categories.show', [ 'category' => $category ] );
        } */
        $category = Category::find( $id );
        return view( 'categories.show', [ 'category' => $category ] );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    /* public function edit( Category $category )
    {
    //
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $categories        = Category::find( $id );
        $categories->name  = $request->name;
        $categories->color = $request->color;
        $categories->save();
        return redirect()->route( 'categories.index' )->with( 'success', 'Categoría Actualizada' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $category = Category::find( $id );
        $category->todos()->each( fn ($todo) => $todo->delete() );
        $category->delete();
        return redirect()->route( 'categories.index' )->with( 'success', 'Categoría Eliminada' );
    }
}