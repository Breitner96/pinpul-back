<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Messages;
use App\Entities\Provider;
use Mail;

class EmailControllers extends Controller
{
    public function contactProvider(Request $request)
    {
        // return $request;
        $providerID = $request->provider_id;
        $provider = Provider::where('id', $providerID)->get();
        $plan = $provider[0]->plan_id;
        // return $plan;
        if($plan == 2){
            // $message = Messages::create( $request->all() );
            $data = $request->all();
            $data['estado'] = 'enviado';
            $message = Messages::create($data);
            Mail::send('emails.response-contact-provider', ['data' => $request], function ($m) use ($request){
                $m->to($request->email, $request->full_name)->subject('Tú mensaje fue recibo');
            });
    
            Mail::send('emails.response-client-provider', ['data' => $request], function ($m) use ($request){
                $m->to('desarrollo@zuntek.co', $request->full_name)->subject('Mensaje de usuario');
            });
        } else {
            $data = $request->all();
            $data['estado'] = 'no enviado';
            $message = Messages::create($data);
            Mail::send('emails.response-client-provider', ['data' => $request], function ($m) use ($request){
                $m->to('desarrollo@zuntek.co', $request->full_name)->subject('Mensaje de usuario');
            });
        }



        return response()->json([
            'messages' => 'Email has been sended'
        ]);
    }

    public function contactPinpul(Request $request)
    {
        Mail::send('emails.response-contact-pinpul', ['data' => $request], function ($m) use ($request){
            $m->to($request->email, $request->nombre)->subject('Tú mensaje fue recibo');
        });

        Mail::send('emails.response-client-pinpul', ['data' => $request], function ($m) use ($request){
            $m->to('desarrollo@zuntek.co', $request->nombre)->subject($request->asunto);
        });

        return response()->json([
            'messages' => 'Email has been sended'
        ]);
    }
    
}
