<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Traits\Utilities;
class PermissionController extends Controller
{

    use Utilities;
    public function __construct()
    {
        // $this->middleware( 'auth:api', ['only' => ['store', 'update','destroy']] );
        $this->middleware( 'jwt.verify', ['only' => ['store', 'update','destroy']] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $permissions = Permission::all();
            return $permissions;
        } else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
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
            $permission = Permission::create( $request->all() );
            return response()->json([
                'messages' => 'Permission has been created'
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
        $permission = Permission::find($id);
        return $permission;
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
            $permission = Permission::find($id);
            $permission->update( $request->all() );
            return response()->json([
                'messages' => 'Permission has been updated'
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
            $permission = Permission::find($id);
            $permission->delete();
            return response()->json([
                'messages' => 'Permission has been deleted'
            ]);

        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
