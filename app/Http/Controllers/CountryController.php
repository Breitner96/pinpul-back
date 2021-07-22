<?php

namespace App\Http\Controllers;

use App\Entities\Country;
use Illuminate\Http\Request;

use App\Traits\Utilities;

class CountryController extends Controller
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
        $countries = Country::all();
        return $countries;
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
            $country = Country::create( $request->all() );
            return response()->json([
                'messages' => 'Country has been created'
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
     * @param  \App\Entities\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return $country;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $country->update( $request->all() );
            return response()->json([
                'messages' => 'Country has been updated'
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
     * @param  \App\Entities\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $country->delete();
            return response()->json([
                'messages' => 'Country has been deleted'
            ]);
        } else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
