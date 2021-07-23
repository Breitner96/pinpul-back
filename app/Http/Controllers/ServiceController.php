<?php

namespace App\Http\Controllers;

use App\Entities\Service;
use Illuminate\Http\Request;
use App\Traits\Utilities;

class ServiceController extends Controller
{
    use Utilities;
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
        $services = Service::all();
        return $services;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $service = Service::create( $request->all() );
            return response()->json([
                'messages' => 'Service has been created'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $service->update( $request->all() );
            return response()->json([
                'messages' => 'Service has been updated'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $service->delete();
            return response()->json([
                'messages' => 'Service has been deleted'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
