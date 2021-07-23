<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Traits\Utilities;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Utilities;

    public function __construct()
    {
        $this->middleware( 'jwt.verify', ['only' => ['store', 'update','destroy']] );
        // $this->middleware( 'auth:api' );
    }


    public function index()
    {
        $roles = Role::all();
        return $roles;
        // $rol = $this->userActive();
        // if( in_array( $rol, $this->returnRoles() ) ){
        //     $roles = Role::all();
        //     return $roles;
        // } else {
        //     return response()->json([
        //         'permission' => 'Not permission'
        //     ]);
        // }
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
            $rol = Role::create( $request->all() );
            return response()->json([
                'messages' => 'Role has been created'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Role::find($id);
        return $rol;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $rol = Role::find($id);
            $rol->update( $request->all() );
            return response()->json([
                'messages' => 'Role has been updated'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $rol = Role::find($id);
            $rol->delete();
            return response()->json([
                'messages' => 'Role has been deleted'
            ]);

        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
