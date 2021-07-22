<?php

namespace App\Http\Controllers;

use App\Entities\Punctuation;
use Illuminate\Http\Request;
use App\Traits\Utilities;
use Illuminate\Support\Facades\DB;

class PunctuationController extends Controller
{
    use Utilities;
    public function __construct()
    {
        $this->middleware( 'auth:api', ['only' => ['store', 'update','destroy']]);
    }

    public function changeStatePuntuaction(Request $request)
    {
        $id = $request[0];
        $pt = DB::update("UPDATE punctuations SET state = 'activo' WHERE id = $id");
        return response()->json([
            'messages' => 'Calificación aprobada'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $punctuacions = Punctuation::all();
        $data = [];
        foreach($punctuacions as $punctuation){
            $data = $punctuation;
            $data['user'] = $punctuation->user;
            $data['provider'] = $punctuation->provider;
            $data['rating'] = $punctuation->rating;
        }
        return $punctuacions;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $punctuation = Punctuation::create( $request->all() );
            return response()->json([
                'messages' => 'Punctuation has been created'
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
     * @param  \App\Entities\Punctuation  $Punctuation
     * @return \Illuminate\Http\Response
     */
    public function show(Punctuation $punctuation)
    {
        return $punctuation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Punctuation  $Punctuation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Punctuation $punctuation)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $punctuation->update( $request->all() );
            return response()->json([
                'messages' => 'Punctuation has been updated'
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
     * @param  \App\Entities\Punctuation  $Punctuation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Punctuation $punctuation)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $punctuation->delete();
            return response()->json([
                'messages' => 'Punctuation has been deleted'
            ]);

        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
