<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();

        return view('admin.comment.list', ['comments' => $comments]);
    }

    public function storePage(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->parent_id = 0;
        $comment->user_id = $request->user_id;
        $comment->film_id = $request->film_id;
        $comment->save();

        return redirect("films/$request->film_id#comment-box")->with('success', 'Thêm bình luận thành công');
    }


    public function updatePage(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Xoá thành công');
    }

    public function destroyPage($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }
}
