<?php

namespace App\Http\Controllers;

use App\Entities\CitiesProviders;

use Illuminate\Http\Request;

class CityProviderController extends Controller
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
        $cities_providers = CitiesProviders::all();
        return $cities_providers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city_provider = CitiesProviders::create( $request->all() );
        return response()->json([
            'messages' => 'CitiesProviders has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\CitiesProviders  $city_provider
     * @return \Illuminate\Http\Response
     */
    public function show(CitiesProviders $city_provider)
    {
        return $city_provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\CitiesProviders  $city_provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CitiesProviders $city_provider)
    {
        $city_provider->update( $request->all() );
        return response()->json([
            'messages' => 'CitiesProviders has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\CitiesProviders  $city_provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(CitiesProviders $city_provider)
    {
        $city_provider->delete();
        return response()->json([
            'messages' => 'CitiesProviders has been deleted'
        ]);
    }
}
