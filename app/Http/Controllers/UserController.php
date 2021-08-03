<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\Utilities;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use Utilities;

    public function __construct()
    {
        // $this->middleware( 'auth:api', ['only' => ['store', 'update','destroy']] );
        $this->middleware( 'jwt.verify' );
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
            $users = User::all();
            $data = [];
            foreach($users as $user){
                $data = $user;
                $data['country'] = $user->country;
                $data['city'] = $user->city;
            }
            return $users;
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
            $data = $request->all();
            
            $rol = $request->rol_id;
            $permissions =  $request->permissions;
     
            $data['password'] = bcrypt($data['password']);
            $user = User::create( $data );
    
            $user->assignRole($rol);
            // $rol->givePermissionTo($permissions);
    
            return response()->json([
                'messages' => 'User has been created'
            ]);
        } else {
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
    public function show(User $user)
    {
        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            $data = $user;
            $data['country'] = $user->country;
            $data['city'] = $user->city;
            // $data['type_document'] = $user->type_document;
            $data['rol'] = $user->rol;
            $data['permissions'] = $user->permissions;
            return $user;
        } else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            // return $request;
            $data = $request->all();
    
            if($request->password == null){
                $data['password'] = User::find($user->id)->setPass();
            } else {
                $data['password'] = Hash::make($request->password);
            }
            
            $user->update( $data );
            $user->syncRoles( $request->rol_id );

            // if( $user->rol[0]->name == 'gerencia' ){
            //     $user->syncRoles( $request->rol_id );
            // }            
            // return $user->rol[0]->name;

            
            return response()->json([
                'messages' => 'User has been updated'
            ]);
        } else {
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
    public function destroy(User $user)
    {
        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            $user->delete();
            return response()->json([
                'messages' => 'Promotion has been deleted'
            ]);
        } else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
