<?php

namespace App\Http\Controllers;

use App\HelpPost;
use App\PostComment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = HelpPost::latest()->get();
        return view('help_post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('help_post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'           => 'required',
            'description'         => 'required',
        ]);
        $post = New HelpPost;
        $post->title = $request->title;
        $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        $post->save();
        Toastr::success('Post Successfully Save','Success');
        return redirect()->route('helppost.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HelpPost  $helpPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post  = HelpPost::find($id);
        return view('help_post.view',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HelpPost  $helpPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post  = HelpPost::find($id);
        return view('help_post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HelpPost  $helpPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title'           => 'required',
            'description'         => 'required',
        ]);
        $post = HelpPost::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        Toastr::success('Post Successfully Update','Success');
        return redirect()->route('helppost.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HelpPost  $helpPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = HelpPost::find($id)->delete();
        Toastr::success('Post Successfully delete','Success');
        return back();
    }

    public function comment(Request $request)
    {
        $comment = New PostComment;
        $comment->user_id = auth()->user()->id;
        $comment->help_post_id = $request->help_post_id;
        $comment->comment = $request->comment;
        $comment->save();
        Toastr::success('Your Comment Successfully Save','Success');
        return back();
    }
}
