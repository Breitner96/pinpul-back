<?php

namespace App\Http\Controllers;

use App\Entities\ProviderService;
use Illuminate\Http\Request;

class ProviderServiceController extends Controller
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
        $providers_services = ProviderService::all();
        return $providers_services;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provider_service = ProviderService::create( $request->all() );
        return response()->json([
            'messages' => 'ProviderService has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\ProviderService  $provider_Service
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderService $provider_service)
    {
        return $provider_service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\ProviderService  $provider_Service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderService $provider_service)
    {
        $provider_service->update( $request->all() );
        return response()->json([
            'messages' => 'ProviderService has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\ProviderService  $provider_Service
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderService $provider_service)
    {
        $provider_service->delete();
        return response()->json([
            'messages' => 'ProviderService has been deleted'
        ]);
    }
}
