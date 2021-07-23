<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use Illuminate\Http\Request;
use App\Traits\Utilities;
class CommentController extends Controller
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
        $comments = Comment::all();
        $data = [];
        foreach($comments as $comment){
            $data = $comment;
            $data['user'] = $comment->user;
        }
        return $comments;
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
            $comment = Comment::create( $request->all() );
            return response()->json([
                'messages' => 'Comment has been created'
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
     * @param  \App\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){
            $comment->update( $request->all() );
            return response()->json([
                'messages' => 'Comment has been updated'
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
     * @param  \App\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $rol = $this->userActive();
        if( in_array( $rol, $this->returnRoles() ) ){

            $comment->delete();
            return response()->json([
                'messages' => 'Comment has been deleted'
            ]);
        }else {
            return response()->json([
                'permission' => 'Not permission'
            ]);
        }
    }
}
