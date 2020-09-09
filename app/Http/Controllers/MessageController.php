<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageDetails;
use App\PostBit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('message.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
        ]);
        $messsage_old = Message::where('lawyer_id',$request->to)->where('user_id',Auth::user()->id)->first();
        if ($messsage_old) {
            $sms = New MessageDetails;
            $sms->message_id = $messsage_old->id;
            $sms->from = Auth::user()->id;
            $sms->to = $request->to;
            $sms->message = $request->message;
            $sms->view = 0;
            $sms->save();
        }else{
            $message = New Message;
            $message->user_id = Auth::user()->id;
            $message->lawyer_id = $request->to;
            $message->save();

            $sms = New MessageDetails;
            $sms->message_id = $message->id;
            $sms->from = Auth::user()->id;
            $sms->to = $request->to;
            $sms->message = $request->message;
            $sms->view = 0;
            $sms->save();
        }
        Toastr::success('Message Successfully Send To Lowyer','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function send(Request $request)
    {
        $sms = New MessageDetails;
        $sms->message_id = $request->message_id;
        $sms->from = Auth::user()->id;
        $sms->to = $request->to;
        $sms->message = $request->message;
        $sms->view = 0;
        $sms->save();
        Toastr::success('Message Successfully Send','Success');
        return back();
    }

    public function details($id)
    {
        $messages = MessageDetails::where('message_id',$id)->get(); 
        return view('message.view',compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function user(Request $request)
    {
        $bit = PostBit::find($request->id);
        return view('inc.message',compact('bit'));
    }
}
