<?php

namespace App\Http\Controllers;

use App\Entities\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{

    public function sendMessage(Request $request){
        // return $request;
        // $message = Messages::create( $request->all() );
        // return response()->json([
        //     'permission' => 'Información enviada'
        // ]);
    }

    public function getGerenciaToProvider($id){
        // return $id;
        $messages = Messages::where('id',$id)->get();
        return $messages;
    }

    public function sendGerenciaToProvider(Request $request){
        // return $request;
        $id = $request->id;
        DB::update( "UPDATE messages SET estado = 'enviado' WHERE id = $id" );
        return response()->json([
            'messages' => 'El mensaje fue enviado al proveedor'
        ]);
    }

    public function messagesProviders($id){
        $messages = Messages::where('provider_id',$id)->where('estado','enviado')->get();
        $data = [];
        foreach($messages as $message){
            $data['provider'] = $message->provider;
            $data['user'] = $message->user;
        }
        return $messages;
    }

    // public function messagesMessages($id){
    //     $messages = Messages::where('provider_id',$id)->get();
    //     return $messages;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Messages::all();
        $data = [];
        foreach($messages as $message){
            $data['provider'] = $message->provider;
            $data['user'] = $message->user;
        }
        return $messages;
    }

    // public function listProvidersByUserId($id){
    //     $messages = Messages::where('provider_id',$id)->get();
    //     $data = [];
    //     foreach($messages as $message){
    //         $data['provider'] = $message->provider;
    //         $data['user'] = $message->user;
    //     }
    //     return $messages;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
