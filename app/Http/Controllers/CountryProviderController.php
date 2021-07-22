<?php

namespace App\Http\Controllers;
use App\Entities\CountriesProvider;

use Illuminate\Http\Request;

class CountryProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth:api', ['only' => ['store', 'update','destroy']] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries_providers = CountriesProvider::all();
        return $countries_providers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country_provider = CountriesProvider::create( $request->all() );
        return response()->json([
            'messages' => 'CountriesProvider has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\CountriesProvider  $country_provider
     * @return \Illuminate\Http\Response
     */
    public function show(CountriesProvider $country_provider)
    {
        return $country_provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\CountriesProvider  $country_provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CountriesProvider $country_provider)
    {
        $country_provider->update( $request->all() );
        return response()->json([
            'messages' => 'CountriesProvider has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\CountriesProvider  $country_provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountriesProvider $country_provider)
    {
        $country_provider->delete();
        return response()->json([
            'messages' => 'CountriesProvider has been deleted'
        ]);
    }
}
