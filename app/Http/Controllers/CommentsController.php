<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the comments for a schedule item.
     *
     * @param  int  $scheduleId
     * @return \Illuminate\Http\Response
     */
    public function index($scheduleId)
    {
        $comments = Comment::where('schedule_id', $scheduleId)
            ->get();
        return response()->json($comments);
    }

    /**
     * Store a newly created comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $scheduleId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $scheduleId)
    {
        $comment = new Comment([
            'schedule_id' => $scheduleId,
            'content' => $request->input('content'),
        ]);
        $comment->save();

        // Load the user relationship
        // $comment->load('user');

        return response()->json($comment, 201);
    }

    /**
     * Remove the specified comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function destroy($id)
{
    $comment = Comment::findOrFail($id);
    $comment->delete();
    return response()->json(null, 204);
}
}
