<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Gallery $gallery, CreateCommentRequest $request){
        $data = $request->validated();
        $user = auth()->user();
        $comment = new Comment;
        $comment->textarea = $data['textarea'];
        $comment->gallery()->associate($gallery);
        $comment->user()->associate($user);
        $comment->save();
        return response()->json($comment);

    }
public function deleteComment(Comment $comment){
$comment->delete();
return response()->noContent();

    


}

    }

