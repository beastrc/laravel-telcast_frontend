<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => ['sometimes'],
            'id' => ['required'],
            'type' => ['required'],
            'content' => ['required']
        ]);

        $data = Auth::user()->comments()->create([
            'parent_id' => $request->input('parent_id') ?? null,
            'commentable_id' => urldecode($request->input('id')),
            'commentable_type' => urldecode($request->input('type')),
            'content' => $request->input('content')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully added!',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Comment $comment)
    {
        return response()->json([
            'status' => true,
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'parent_id' => ['sometimes'],
            'id' => ['required'],
            'type' => ['required'],
            'content' => ['required']
        ]);

        $comment->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted!'
        ]);
    }
}
