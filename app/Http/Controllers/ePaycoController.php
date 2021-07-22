<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// require '../../../vendor/autoload.php';
use Epayco\Epayco;


class ePaycoController extends Controller
{

    public $epayco;
    
    public function __construct()
    {
        // $this->middleware( 'auth:api', ['only' => ['store', 'update','destroy']] );
        $this->epayco = new Epayco(array(
            "apiKey" => "12d555da4bacf9ebd63c1c50a178e52c",
            "privateKey" => "0192e3a2ca5864818acabaeba7b5030d",
            "lenguage" => "ES",
            "test" => true
        ));
        // return $epayco;
    }

    public function createTokenClient(Request $request){
        $token = $this->epayco->token->create(array(
            "card[number]" => '4575623182290326',
            "card[exp_year]" => "2017",
            "card[exp_month]" => "07",
            "card[cvc]" => "123"
        ));
        return response()->json([
            'response' => $token
        ]);
    }

    public function createCustomer(Request $request){
        $customer = $this->epayco->customer->create(array(
            "token_card" => '0f0de4605af044c24640a95', // 0f0de4605af044c24640a95 - $token->id
            "name" => "Joe",
            "last_name" => "Doe", //This parameter is optional
            "email" => "joe@payco.co",
            "default" => true,
            //Optional parameters: These parameters are important when validating the credit card transaction
            "city" => "Bogota",
            "address" => "Cr 4 # 55 36",
            "phone" => "3005234321",
            "cell_phone"=> "3010000001",
        ));
        return response()->json([
            'response' => $customer
        ]);
    }

    public function generateSubscription(Request $request){
        $subscription = $this->epayco->subscriptions->create(array(
            "id_plan" => "Week_Suscription", // Week_Suscription
            "customer" => "xzoGqMKQPuYxun7x5", // xzoGqMKQPuYxun7x5
            "token_card" => "0f0de4605af044c24640a95", // 0f0de4605af044c24640a95
            "doc_type" => "CC",
            "doc_number" => "5234567",
             //Optional parameter: if these parameter it's not send, system get ePayco dashboard's url_confirmation
             "url_confirmation" => "https://ejemplo.com/confirmacion",
             "method_confirmation" => "POST"
        ));

        return response()->json([
            'response' => $subscription
        ]);
    }

}
