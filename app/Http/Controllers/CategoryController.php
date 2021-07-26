<?php

namespace App\Http\Controllers;

use App\Traits\Utilities;
use App\Entities\Provider;
use App\Entities\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CategoryController extends Controller
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
        // return $this->userCanDo();
        $categories = Category::all();
        return $categories;
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

            $fileName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('img'), $fileName);
            $category = Category::create([
                'category' => $request->category,
                'imagen' => $fileName,
                'slug' => Str::slug($request->category),
                'views' => 0
            ]);
            return response()->json([
                'messages' => 'Category has been created'
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
     * @param  \App\Entities\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    public function slug($name)
    {
        // return $name;
        $categories = DB::select("SELECT * FROM categories WHERE slug = '$name' ");
        $idCategory = $categories[0]->id;
        $views = $categories[0]->views + 1;
        DB::update( "UPDATE categories SET views = $views WHERE id = $idCategory" );

        $providers = DB::select("
            SELECT * FROM category_providers
            INNER JOIN categories ON categories.id = category_providers.category_id
            INNER JOIN providers ON providers.id = category_providers.provider_id
            WHERE categories.slug = '$name'
            AND providers.state = 'activo'
        ");

        $data = [];
        foreach($providers as $provider){
            $data = DB::select("
                SELECT * FROM category_providers
                INNER JOIN providers ON providers.id = category_providers.provider_id
                INNER JOIN categories ON categories.id = $idCategory
                WHERE providers.id = $provider->id
            ");
        }


        return response()->json([
            'providers' => $providers,
            'categories' => $data
        ]);
        // return $abc;
        // return $categoriesProviders;



        // $categoriesProviders = DB::select("
        //     SELECT
        //     category_providers.id AS IDPROVIDERPIVOT,
        //     category_providers.category_id AS IDCATEGORYPIVOT,
        //     category_providers.provider_id AS IDPROVIDERPIVOT,
        //     categories.id AS CATEGORYID,
        //     categories.slug AS SLUGCATEGORY,
        //     categories.*,
        //     providers.id AS PROVIDERID,
        //     providers.slug AS SLUGPROVIDER,
        //     providers.*
        //     FROM category_providers
        //     INNER JOIN categories ON categories.id = category_providers.category_id
        //     INNER JOIN providers ON providers.id = category_providers.provider_id
        //     WHERE category_providers.category_id = $idCategory
        //     AND providers.state = 'activo'
        //     AND categories.slug = 'cuero'
        // ");

        


        // $categories = Category::where('slug',$name)->get();
        // $id = $categories[0]->id;
        // $views = $categories[0]->views + 1;
        // DB::update( "UPDATE categories SET views = $views WHERE id = $id" );
        // $data = [];
        // foreach($categories as $category){
        //     $data['provider'] = $category->providers->where('state','activo');
        // }

        // if( count( $data['provider'] ) > 0 ) {
        //     $idProvider = $data['provider'][0]->id;
        //     $provider = Provider::where('id',$id)->get();
        //     $categoriesProviders = [];
        //     foreach($provider as $prov){
        //         $categoriesProviders['catProvider'] = $prov->categories;
        //     }
    
        //     return response()->json([
        //         'providers' => $data['provider'],
        //         'categories' => $categoriesProviders
        //     ]);
        // } else {
        //     return response()->json(['No existen proveedores en esta categoría']);
        // }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category  $category)
    {
        // return $request;
        // die();
        $rol = $this->userActive();
        
        if( in_array( $rol, $this->returnRoles() ) ){
            
            $validator = Validator::make($request->all(), [
            'imagen' => [
                'mimes:jpeg,png',
                'max:2000'
                ]
            ]);
                
            if ($validator->fails()) {
                return response()->json([
                    'error' => 'El formato de la imagen no es permitido o excede su peso, por favor verifique que la imagen sea un formato: .png o jpg y que su peso no exceda los 2MB'
                ]);
            }
            
            if($request->imagen == null){
                $category->category = $request->category;
                $category->imagen = $category->imagen;
                $category->slug = Str::slug($request->category);
                $category->views = $category->views;
                $category->save();
            } else {
                $fileName = time().'.'.$request->imagen->extension();
                $request->imagen->move(public_path('img'), $fileName);

                $category->category = $request->category;
                $category->imagen = $fileName;
                $category->slug = Str::slug($request->category);
                $category->views = $category->views;
                $category->save();
            }
    
            return response()->json([
                'messages' => 'Category has been updated'
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
     * @param  \App\Entities\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            $category->delete();
            return response()->json([
                'messages' => 'Category has been deleted'
            ]);
        } else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
