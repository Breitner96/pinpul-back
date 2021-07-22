<?php

namespace App\Http\Controllers;

use App\Entities\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Utilities;

class PromotionController extends Controller
{
    use Utilities;
    public function __construct()
    {
        $this->middleware( 'auth:api', ['only' => ['store', 'update','destroy']] );
    }

    /**;
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        $star = date("Y-m-d");

        foreach ($promotions as $array) {
            $end = date("$array->end_promotion");
            if($star > $end){
                $sql = DB::update("UPDATE promotions SET status = 'inactivo' WHERE id = $array->id");
            } 
            // else {
            //     $sql = DB::update("UPDATE promotions SET status = 'activo' WHERE id = $array->id");
            // }
        }
        return $promotions;
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
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $fileName);
            $promotion = Promotion::create([
                'provider_id' => $request->provider_id,
                'image' => $fileName,
                'title' => $request->title,
                'description' => $request->description,
                'discount' => $request->discount,
                'start_promotion' => $request->start_promotion,
                'end_promotion' => $request->end_promotion,
                'status' => $request->status
    
            ]);
            return response()->json([
                'messages' => 'Category has been created'
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
     * @param  \App\Entities\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return $promotion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $rol = $this->userActive();if( in_array( $rol, $this->returnRoles() ) ){

        
        $data = $request->all();

        // if ($request->image==null) {
        //     # code...

            

        //         $data['image'] = Promotion::find($promotion->image)->setImage();
        //         // $data['image'] = $fileName;
        
        //         $promotion->update( $data );
        
        //         return response()->json([
        //             'messages' => 'Promotion has been updated'
        //         ]);
        // }

        // else{

        //     $fileName = time().'.'.$request->image->extension();
        //     $request->image->move(public_path('img'), $fileName);

        //     $data['image'] = $fileName;

        //     $promotion->update( $data );

        //     return response()->json([
        //         'messages' => 'Promotion has been updated'
        //     ]);


        // }

        if($request->imagen == null){
            $data['image'] = $promotion->image;
            $promotion->update( $data );

            return response()->json([
                'messages' => 'Promotion has been updated'
            ]);

        } else {
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $fileName);

            $data['image'] = $fileName;

            $promotion->update( $data );

            return response()->json([
                'messages' => 'Promotion has been updated'
            ]);
        }
    }else {
        return response()->json([
            'permission' => 'Not permission'
        ]);
    }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $promotion->delete();
            return response()->json([
                'messages' => 'Promotion has been deleted'
            ]);

        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
