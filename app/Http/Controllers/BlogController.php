<?php

namespace App\Http\Controllers;

use App\Entities\Blog;
use App\Traits\Utilities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
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
        $blogs = Blog::all();
        return $blogs;
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

            $fileName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('img'), $fileName);

            $category = Blog::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'imagen' => $fileName,
                'content' => $request->content
            ]);
            return response()->json([
                'messages' => 'Article has been created'
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return $blog;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
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
                $blog->title = $blog->title;
                $blog->slug = Str::slug($blog->slug);
                $blog->imagen = $blog->imagen;
                $blog->content = $blog->content;
                $blog->save();
            } else {
                $fileName = time().'.'.$request->imagen->extension();
                $request->imagen->move(public_path('img'), $fileName);

                $blog->title = $request->title;
                $blog->slug = Str::slug($request->slug);
                $blog->imagen = $fileName;
                $blog->content = $request->content;

                $blog->save();
            }
    
            return response()->json([
                'messages' => 'Category has been updated'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $rol = $this->userActive();

        if( in_array( $rol, $this->returnRoles() ) ){
            $blog->delete();
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
