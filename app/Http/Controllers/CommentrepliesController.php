<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;

class CommentrepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $replies = CommentReply::all();
        return view('admin.comment.replies.index',['replies' => $replies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();
        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->avatar,
            'body' => $request->body
        ];
        CommentReply::create($data);
        $request->session()->flash('comment_reply_message','your comment reply has been submitted and waiting for approval');
        //
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
//        //
        $comment = Comment::findOrFail($id);
        $replies =  $comment->replies->all();
        return view('admin.comment.replies.show',['replies'=>$replies]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        CommentReply::findorfail($id)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CommentReply $reply,Request $request)
    {
        //

        $reply->delete();
//        Session::flash('message' , 'post has deleted');
        $request->session()->flash('reply_delete' , 'Reply was deleted');
        return redirect()->back();
    }
}
