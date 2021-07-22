<?php

namespace App\Http\Controllers;

use App\Entities\TypeDocument;
use Illuminate\Http\Request;
use App\Traits\Utilities;

class TypeDocumentController extends Controller
{
    use Utilities;
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
        $type_couments = TypeDocument::all();
        return $type_couments;
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
            $type_coument = TypeDocument::create( $request->all() );
            return response()->json([
                'messages' => 'TypeDocument has been created'
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
     * @param  \App\Entities\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDocument $typeDocument)
    {
        return $typeDocument;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeDocument $typeDocument)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $typeDocument->update( $request->all() );
            return response()->json([
                'messages' => 'TypeDocument has been updated'
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
     * @param  \App\Entities\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDocument $typeDocument)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $typeDocument->delete();
            return response()->json([
                'messages' => 'TypeDocument has been deleted'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
