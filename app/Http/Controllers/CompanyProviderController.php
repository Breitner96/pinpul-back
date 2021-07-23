<?php

namespace App\Http\Controllers;
use App\Entities\CompaniesProviders;

use Illuminate\Http\Request;

class CompanyProviderController extends Controller
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
        $companies_providers = CompaniesProviders::all();
        return $companies_providers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company_provider = CompaniesProviders::create( $request->all() );
        return response()->json([
            'messages' => 'CompaniesProviders has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\CompaniesProviders  $company_provider
     * @return \Illuminate\Http\Response
     */
    public function show(CompaniesProviders $company_provider)
    {
        return $company_provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\CompaniesProviders  $company_provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompaniesProviders $company_provider)
    {
        $company_provider->update( $request->all() );
        return response()->json([
            'messages' => 'CompaniesProviders has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\CompaniesProviders  $company_provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompaniesProviders $company_provider)
    {
        $company_provider->delete();
        return response()->json([
            'messages' => 'CompaniesProviders has been deleted'
        ]);
    }
}
