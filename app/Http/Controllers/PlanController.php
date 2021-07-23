<?php

namespace App\Http\Controllers;

use App\Entities\Plan;
use Illuminate\Http\Request;
use App\Traits\Utilities;

class PlanController extends Controller
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
        $plans = Plan::all();
        return $plans;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;

        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            $plan = Plan::create( $request->all() );
            return response()->json([
                'messages' => 'Plan has been created'
            ]);

        }else{
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return $plan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {   
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $plan->update( $request->all() );
            return response()->json([
                'messages' => 'Plan has been updated'
            ]);
        }else{
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $plan->delete();
            return response()->json([
                'messages' => 'Plan has been deleted'
            ]);
        }else{
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
