<?php

namespace App\Http\Controllers;
use App\Entities\ClientsProvider;

use Illuminate\Http\Request;

class ClientProviderController extends Controller
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
        $clients_providers = ClientsProvider::all();
        return $clients_providers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client_provider = ClientsProvider::create( $request->all() );
        return response()->json([
            'messages' => 'ClientsProvider has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\ClientsProvider  $client_provider
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsProvider $client_provider)
    {
        return $client_provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\ClientsProvider  $client_provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientsProvider $client_provider)
    {
        $client_provider->update( $request->all() );
        return response()->json([
            'messages' => 'ClientsProvider has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\ClientsProvider  $client_provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsProvider $client_provider)
    {
        $client_provider->delete();
        return response()->json([
            'messages' => 'ClientsProvider has been deleted'
        ]);
    }
}
