<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;


use Illuminate\Support\Facades\Config;


class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor-api,ChildParent-api');
    }

    // get all replies of a comment
    public function index($id)
    {
        
        $comment = Comment::find($id);

        if(!$comment)
        {
            return response([
                'message' => 'Comment not found.'
            ], 403);
        }

        return response([
            'replies' => $comment->replies()->with('child_parent:id,name,image')->get()
        ], 200);
    }

    // create a reply
    public function store(Request $request)
    {
        $reply = Reply::find($request->comment_id);

        if(!$reply)
        {
            return response([
                'message' => 'reply not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'reply' => 'required|string'
        ]);

        Reply::create([
            'reply' => $attrs['reply'],
            'post_id' => $request->post_id,

            'comment_id' => $request->comment_id,

            'child_parent_id' => auth()->user()->id
        ]);

        return response([
            'message' => 'reply created.'
        ], 200);
    }

    // update a reply
    public function update(Request $request, $id)
    {
        $reply = Reply::find($id);

       if(!$reply)
        {
            return response([
                'message' => 'reply not found.'
            ], 403);
        }

        if($reply->child_parent_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'reply' => 'required|string'
        ]);

        $reply->update([
            'reply' => $attrs['reply']
        ]);

        return response([
            'message' => 'reply updated.'
        ], 200);
    }

    // delete a reply
    public function destroy($id)
    {
        $reply = Reply::find($id);

        if(!$reply)
        {
            return response([
                'message' => 'reply not found.'
            ], 403);
        }

        if($reply->child_parent_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $reply->delete();

        return response([
            'message' => 'reply deleted.'
        ], 200);
    }

    ////////doctor//////


    // get all replies of a comment
    public function index_1($id)
    {
        
        $comment = Comment::find($id);

        if(!$comment)
        {
            return response([
                'message' => 'Comment not found.'
            ], 403);
        }

        return response([
            'replies' => $comment->replies()->with('doctor:id,name,image')->get()
        ], 200);
    }


    // create a reply
    public function store_1(Request $request)
    {
        $reply = reply::find($request->comment_id);

        if(!$reply)
        {
            return response([
                'message' => 'reply not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'reply' => 'required|string'
        ]);

        Reply::create([
            'reply' => $attrs['reply'],
            'post_id' => $request->post_id,
            'comment_id' => $request->comment_id,
            'doctor_id' => auth()->user()->id
        ]);

        return response([
            'message' => 'reply created.'
        ], 200);
    }

    // update a reply
    public function update_1(Request $request, $id)
    {
        $reply = Reply::find($id);

       if(!$reply)
        {
            return response([
                'message' => 'reply not found.'
            ], 403);
        }

        if($reply->doctor_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'reply' => 'required|string'
        ]);

        $reply->update([
            'reply' => $attrs['reply']
        ]);

        return response([
            'message' => 'reply updated.'
        ], 200);
    }

    // delete a reply
    public function destroy_1($id)
    {
        $reply = Reply::find($id);

        if(!$reply)
        {
            return response([
                'message' => 'reply not found.'
            ], 403);
        }

        if($reply->doctor_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $reply->delete();

        return response([
            'message' => 'reply deleted.'
        ], 200);
    }

}
