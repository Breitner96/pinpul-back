<?php

namespace App\Http\Controllers;

use App\Entities\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Utilities;

class CityController extends Controller
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
        $cities = City::all();
        $data = [];
        foreach($cities as $city){
            $data = $city;
            $data['country'] = $city->country;
        }
        return $cities;
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
            $city = City::create( $request->all() );
            return response()->json([
                'messages' => 'City has been created'
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
     * @param  \App\Entities\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return $city;
    }

    public function cityByCountry($id){
        $cities = City::where('country_id',$id)->get();
        return $cities;


        // $ids = [1,3];
        // $data = [];
        // for($i = 0; $i <= count($ids) - 1; $i++ ){
        //     $sql = DB::select("SELECT * FROM cities WHERE country_id LIKE $ids[$i]");
        //     $data = $sql;
        // }
        // return $data;

    }

    public function countryByCities($id){
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            $city->update( $request->all() );
            return response()->json([
                'messages' => 'City has been updated'
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
     * @param  \App\Entities\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $city->delete();
            return response()->json([
                'messages' => 'City has been deleted'
            ]);
        } else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
