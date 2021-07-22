<?php

namespace App\Http\Controllers;

use App\Entities\TypeCompany;
use Illuminate\Http\Request;
use App\Traits\Utilities;

class TypeCompanyController extends Controller
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
        $type_companies = TypeCompany::all();
        return $type_companies;
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
            $type_company = TypeCompany::create( $request->all() );
            return response()->json([
                'messages' => 'TypeCompany has been created'
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
     * @param  \App\Entities\TypeCompany  $typeCompany
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCompany $typeCompany)
    {
        return $typeCompany;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\TypeCompany  $typeCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeCompany $typeCompany)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $typeCompany->update( $request->all() );
            return response()->json([
                'messages' => 'TypeCompany has been updated'
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
     * @param  \App\Entities\TypeCompany  $typeCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeCompany $typeCompany)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $typeCompany->delete();
            return response()->json([
                'messages' => 'TypeCompany has been deleted'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
