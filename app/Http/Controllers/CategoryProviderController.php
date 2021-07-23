<?php

namespace App\Http\Controllers;

use App\Entities\CategoryProvider;
use Illuminate\Http\Request;

class CategoryProviderController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'jwt.verify', ['only' => ['store', 'update','destroy']] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories_providers = CategoryProvider::all();
        return $categories_providers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_provider = CategoryProvider::create( $request->all() );
        return response()->json([
            'messages' => 'CategoryProvider has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Category_Provider  $category_Provider
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProvider $category_provider)
    {
        return $category_provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\CategoryProvider  $category_Provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProvider $category_provider)
    {
        $category_provider->update( $request->all() );
        return response()->json([
            'messages' => 'CategoryProvider has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\CategoryProvider  $category_Provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProvider $category_provider)
    {
        $category_provider->delete();
        return response()->json([
            'messages' => 'CategoryProvider has been deleted'
        ]);
    }
}
