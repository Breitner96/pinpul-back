<?php

namespace App\Http\Controllers;

use App\Entities\TypeClient;
use Illuminate\Http\Request;
use App\Traits\Utilities;
class TypeClientController extends Controller
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
        $type_clients = TypeClient::all();
        return $type_clients;
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
            $type_client = TypeClient::create( $request->all() );
            return response()->json([
                'messages' => 'TypeClient has been created'
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
     * @param  \App\Entities\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function show(TypeClient $typeClient)
    {
        return $typeClient;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeClient $typeClient)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $typeClient->update( $request->all() );
            return response()->json([
                'messages' => 'TypeClient has been updated'
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
     * @param  \App\Entities\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeClient $typeClient)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){

            $typeClient->delete();
            return response()->json([
                'messages' => 'TypeClient has been deleted'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
