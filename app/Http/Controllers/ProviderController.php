<?php

namespace App\Http\Controllers;

use App\Traits\Utilities;
use App\Entities\Provider;
use App\Entities\Category;
use App\Entities\Promotion;
use App\Entities\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Entities\ContadorMes;
use Illuminate\Support\Facades\DB;
use App\Entities\ChangesProviders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
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
        $providers = Provider::all();
        $data = [];
        foreach($providers as $provider){
            $data['categories'] = $provider->categories;
            $data['services'] = $provider->services;
            $data['companies'] = $provider->companies;
            $data['clients'] = $provider->clients;
            $data['countries'] = $provider->countries;
            $data['cities'] = $provider->cities;
            $data['country'] = $provider->country;
            $data['city'] = $provider->city;
            $data['plan'] = $provider->plan;
        }
        return $providers;
    }

    public function listProviders(){
        $providers = Provider::where('state','=','activo')->get();
        $data = [];
        foreach($providers as $provider){
            $data['categories'] = $provider->categories;
            $data['services'] = $provider->services;
            $data['companies'] = $provider->companies;
            $data['clients'] = $provider->clients;
            $data['countries'] = $provider->countries;
            $data['cities'] = $provider->cities;
            $data['country'] = $provider->country;
            $data['city'] = $provider->city;
            $data['plan'] = $provider->plan;
        }
        return $providers;
    }

    public function contadorMesGratis(Request $request){
        $mes = date('n');
        $idProvider = $request[0];
        $contadorMes = ContadorMes::where('provider_id', $idProvider)->where('mes',$mes)->get();
        if( count($contadorMes) > 0){
            $views = $contadorMes[0]->vistas + 1;
            DB::update( "UPDATE contador_mes SET vistas = $views WHERE provider_id = $idProvider" );
            return $contadorMes;
        } else {
            $createConProvider = ContadorMes::create([
                'provider_id' => $idProvider,
                'mes' => $mes,
                'vistas' => 1
            ]);
            return $createConProvider;
        }
    }

    /**
     * Store a newly created resource in storage.
     *Provider
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();        

        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            

            // /* Obtener categorías */
            $categories = explode(',',$request->category_id);

            // /* Obtener Tipos de clientes */
            $clients = explode(',',$request->type_client_id);
            // /* Obtener paises */
            $countries = explode(',',$request->countries_id); 

            // /* Obtener ciudades */
            $cities = explode(',',$request->cities_id);

            $validator = Validator::make($request->all(), [
                'logo' => [
                    'mimes:jpeg,png',
                    'max:2000'
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Error al subir el logo'
                ]);
            }

            // /* Obtener imagen */
            $fileName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('img'), $fileName);

            $data['user_id'] = $userLoggedIn = auth()->user()->id;
            $data['logo'] = $fileName;
            $data['slug'] = Str::slug($request->provider);
            
            $provider = Provider::create( $data );

            $providerAdded = Provider::find($provider->id);
            $providerAdded->categories()->attach($categories);
            $providerAdded->clients()->attach($clients);
            $providerAdded->countries()->attach($countries);
            $providerAdded->cities()->attach($cities);

            $dataToCompered = [];
            $dataToCompered['provedor_id'] = $provider->id;
            $dataToCompered['info'] = $data;
            $dataToCompered['clients'] = $clients;
            $dataToCompered['countries'] = $countries;
            $dataToCompered['cities'] = $cities;

            // return $dataToCompered;
            // $changesProvider = DB::insert("INSERT INTO changes_providers (provider_id, info, state)
            // VALUES (?,?,?)" , [$provider->id, $dataToCompered, 'pendiente' ]);

            // $changesProvider = ChangesProviders::create([
            //     'provider_id' => $provider->id,
            //     'info' => $dataToCompered,
            //     'state' => 'pendiente'
            // ]);

            // $galeria = $request->image;
            // for($i = 0; $i <= count($galeria) - 1; $i++ ){
            //         $validator = Validator::make($request->all(), [
            //             'image' => [
            //                 'mimes:jpeg,png',
            //                 'max:2000'
            //             ],
            //         ]);
            //         if ($validator->fails()) {
            //             return response()->json([
            //                 'error' => 'Error al subir la galería de imágenes'
            //             ]);
            //         }
            // }

            /* Galería */
            $fileNames = [];
            if( $request->image > 0 ){
                for($i = 0; $i <= count($request->image) - 1; $i++ ){
                    $fileNames[$i] = time()."-f-$i.".$request->image[$i]->extension();
                    $request->image[$i]->move(public_path('img'), $fileNames[$i]);
                    $providerAdded->images()->create([
                        'image' => $fileNames[$i]
                    ]);
                }
            }

            // $documentos = $request->document;
            // for($i = 0; $i <= count($documentos) - 1; $i++ ){
            //         $validator = Validator::make($request->all(), [
            //             'file' => [
            //                 'mimes:pdf',
            //                 'max:2000'
            //             ],
            //         ]);
            //         if ($validator->fails()) {
            //             return response()->json([
            //                 'error' => 'Error al subir los documentos'
            //             ]);
            //         }
            // }

            // Documentos
            $fileDocument=[];
            if( $request->document > 0 ){
                for($i = 0; $i <= count($request->document) - 1; $i++ ){
                    $fileDocument[$i] = time()."-d-$i.".$request->document[$i]->extension();
                    $request->document[$i]->move(public_path('documents'), $fileDocument[$i]);
                    $providerAdded->documents()->create([
                        'document' => $fileDocument[$i]
                    ]);
                }
            }

            return response()->json([
                'messages' => 'Provider has been created'
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
     * @param  \App\Entities\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Provider::find($id);
        $data = $proveedor;
        $data['categories'] = $proveedor->categories;
        $data['services'] = $proveedor->services;
        $data['companies'] = $proveedor->companies;
        $data['clients'] = $proveedor->clients;
        $data['countries'] = $proveedor->countries;
        $data['cities'] = $proveedor->cities;
        $data['images'] = $proveedor->images;
        $data['country'] = $proveedor->country;
        $data['city'] = $proveedor->city;
        $data['plan'] = $proveedor->plan;
        $data['type_document'] = $proveedor->typeDocument;
        $data['documents'] = $proveedor->documents;
        $data['clients'] = $proveedor->clients;
        return $data;
    }

    public function slug($name)
    {
        $provider = Provider::where('slug',$name)->where('state','activo')->first();
        $providerDos = Provider::where('slug',$name)->where('state','activo')->get();

        $interes = [];
        foreach($provider->categories as $c){
            $sql ="
                SELECT * FROM category_providers
                INNER JOIN providers ON providers.id = category_providers.provider_id
                INNER JOIN categories ON categories.id = category_providers.category_id
                WHERE categories.id = $c->id
                ORDER BY category_providers.provider_id
                LIMIT 3
            ";
            $interes = DB::select($sql);
        }

        $data = $provider;
        $data['categories'] = $provider->categories;
        $data['clients'] = $provider->clients;
        $data['countries'] = $provider->countries;
        $data['cities'] = $provider->cities;
        $data['images'] = $provider->images;
        $data['documents'] = $provider->documents;
        $data['country'] = $provider->country;
        $data['city'] = $provider->city;
        $data['plan'] = $provider->plan;
        $views = $data['views'] + 1;

        return response()->json([
            'provider' => $data,
            'interes' => $interes,
        ]);
    }

    public function peopleCount(Request $request){
        $provider = Provider::where('id',$request[0])->first();
        $views = $provider['views_tel'] + 1;
        DB::update( "UPDATE providers SET views_tel = $views WHERE id = $provider->id" );
        return $provider;
    }

    public function getProviderByUser($id){
        $providers = Provider::where('user_id',$id)->get();
        // return $providers;
        $data = [];
        foreach($providers as $provider){
            $data['categories'] = $provider->categories;
            $data['services'] = $provider->services;
            $data['companies'] = $provider->companies;
            $data['clients'] = $provider->clients;
            $data['countries'] = $provider->countries;
            $data['cities'] = $provider->cities;
            $data['country'] = $provider->country;
            $data['city'] = $provider->city;
            $data['plan'] = $provider->plan;
        }
        return $providers;
    }

    public function eliminarFotoGaleria(Request $request)
    {
        $id = intval($request->provider_id);
        $image = $request->imagen;
        DB::delete( "DELETE FROM images WHERE imagetable_id = $id AND image = '$image'" );
        return response()->json([
            'messages' => 'Imagen eliminada'
        ]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            // return $request->all();

        
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                // 'imagen' => ['image']
                'imagen' => [
                    'mimes:jpeg,png',
                    'max:2000'
                    // 'dimensions:width=600,height=400' // dimensions:min_width=600,min_height=400'
                ]
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'El formato de la imagen no es permitido o excede su peso, por favor verifique que la imagen sea un formato: .png o jpg y que su peso no exceda los 2MB'
                ]);
            }


            if($request->logo == null){
                // $category->category = $request->category;
                $provider->logo = $provider->logo;
                // $category->slug = Str::slug($request->category);
                // $category->views = $category->views;
                // $category->save();

                $categories = explode(',',$request->category_id);
                $clients = explode(',',$request->type_client_id);
                $countries = explode(',',$request->countries_id); 
                $cities = explode(',',$request->cities_id);  

                $provider->categories()->sync($categories);
                $provider->clients()->sync($clients);
                $provider->countries()->sync($countries);
                $provider->cities()->sync($cities);

                $provider->update( $request->all() );
                // $provider->save();
            } else {
                $fileName = time().'.'.$request->logo->extension();
                $request->logo->move(public_path('img'), $fileName);

                $categories = explode(',',$request->category_id);
                $clients = explode(',',$request->type_client_id);
                $countries = explode(',',$request->countries_id); 
                $cities = explode(',',$request->cities_id);  

                $provider->categories()->sync($categories);
                $provider->clients()->sync($clients);
                $provider->countries()->sync($countries);
                $provider->cities()->sync($cities);
                $provider->update( $request->all() );
                // $provider->save();
            }

            // if($request->logo == null){
            //     $data['logo'] = $provider->logo;

            //     // $categories = explode(',',$request->category_id);
            //     // $services = explode(',',$request->service_id);
            //     // $companies = explode(',',$request->type_company_id);
            //     // $clients = explode(',',$request->type_client_id);
            //     // $countries = explode(',',$request->countries_id);  
            //     // $cities = explode(',',$request->cities_id);  

        
            //     // $data['slug'] = Str::slug($request->provider);
        
            //     // $provider->update( $data );
            //     // $provider->categories()->sync($categories);
            //     // $provider->services()->sync($services);
            //     // $provider->companies()->sync($companies);
            //     // $provider->clients()->sync($clients);
            //     // $provider->countries()->sync($countries);
            //     // $provider->cities()->sync($cities);
                
            // } else {
        
            //     $categories = explode(',',$request->category_id);
            //     $clients = explode(',',$request->type_client_id);
            //     $countries = explode(',',$request->countries_id);  
            //     $cities = explode(',',$request->cities_id);

            //     /* Obtener imagen */
            //     $fileName = time().'.'.$request->logo->extension();
            //     $request->logo->move(public_path('img'), $fileName);
            //     $data['logo'] = $fileName;

            //     $data['slug'] = Str::slug($request->provider);

            //     $provider->save( $data );
            //     $provider->categories()->sync($categories);
            //     $provider->clients()->sync($clients);
            //     $provider->countries()->sync($countries);
            //     $provider->cities()->sync($cities);

            //     // $provider->update( $data );
            // }


            $providerAdded = Provider::find($provider->id);

            /* Galería */
            if($request->image == null){
                $data['image'] = $provider->image;
            } else {
                $fileNames = [];
                if( $request->image > 0 ){
                    for($i = 0; $i <= count($request->image) - 1; $i++ ){
                        $fileNames[$i] = time()."-f-$i.".$request->image[$i]->extension();
                        $request->image[$i]->move(public_path('img'), $fileNames[$i]);
                        $providerAdded->images()->create([
                            'image' => $fileNames[$i]
                        ]);
                    }
                }
            }

            /* Documentos */
            if($request->document == null){
                $data['document'] = $provider->document;
            } else {
                $fileDocument=[];
                if( $request->document > 0 ){
                    for($i = 0; $i <= count($request->document) - 1; $i++ ){
                        $fileDocument[$i] = time()."-d-$i.".$request->document[$i]->extension();
                        $request->document[$i]->move(public_path('documents'), $fileDocument[$i]);
                        $providerAdded->documents()->create([
                            'document' => $fileDocument[$i]
                        ]);
                    }
                }
            }
            
            return response()->json([
                'messages' => 'Provider has been updated',
                'datos' => $provider
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
     * @param  \App\Entities\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $provider->categories()->detach();
            // $provider->services()->detach();
            // $provider->companies()->detach();
            $provider->clients()->detach();
            $provider->countries()->detach();
            $provider->cities()->detach();
            
            $provider->delete();
            return response()->json([
                'messages' => 'Provider has been deleted'
            ]);

        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }

    public function images($id){
        $galery = Provider::find($id);
        return $galery->images;
    }

    public function documents($id){
        $document = Provider::find($id);
        return $document->documents;
    }

    
}
