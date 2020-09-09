<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostBit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawyerController extends Controller
{
    public function post()
    {
    	$posts = Post::latest()->get();
    	return view('lawyer.post.index',compact('posts'));
    }

    public function post_show($id)
    {
        $post  = Post::find($id);
        return view('lawyer.post.view',compact('post'));
    }

	public function bit(Request $request)
	{
		$this->validate($request,[
            'bit' => 'required|min:25',
        ]);

        $bit = New PostBit;
        $bit->user_id = Auth::user()->id;
        $bit->post_id = $request->post_id;
        $bit->bit = $request->bit;
        $bit->save();
        Toastr::success('Post Successfully Save','Success');
        return back();
	}
}
