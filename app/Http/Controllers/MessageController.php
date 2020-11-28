<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageDetails;
use App\PostBit;
use App\User;
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


    public function appointment(Request $request)
    {
        $sms = New MessageDetails;
        $sms->message_id = $request->message_id;
        $sms->from = Auth::user()->id;
        $sms->to = $request->to;
        $sms->view = 0;
        $sms->message = 'Appointment Sending';
        $sms->appointment = 1;
        $sms->appointment_date = $request->appointment_date;
        $sms->appointment_amount = $request->appointment_amount;
        $sms->save();
        Toastr::success('Message Successfully Send','Success');
        return back();
    }

    public function appointment_pay(Request $request)
    {
        $message = MessageDetails::findorFail($request->message_id);
        $name = $message->user->name;
        $price = $message->appointment_amount;
        $plan_id = $message->id;
        $success = route('message.appointment.pay.success');
        $fail = route('paymnet.pricing');
        $cancel = route('paymnet.pricing');
        $post_data = array();

        $post_data['store_id'] = "easyt5d47c1bdea896";

        $post_data['store_passwd'] = "easyt5d47c1bdea896@ssl";
        $post_data['total_amount'] = $price;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = now();

        $post_data['success_url'] = $success;
        $post_data['fail_url'] = $fail;
        $post_data['cancel_url'] = $cancel;

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $message->id;
        $post_data['value_b'] = '';
        $post_data['value_c'] = Auth::user()->id;
        $post_data['value_d'] = '';
        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
        $content = curl_exec($handle );
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }
        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );
        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            exit;
        } else {
            echo "JSON Data parsing error!";
        }
    }

    public function appointment_success(Request $request)
    {
        $user = User::find($request->value_c);
        auth()->login($user, true);

        $message = MessageDetails::findorFail($request->value_a);
        $sms = New MessageDetails;
        $sms->message_id = $message->message_id;
        $sms->from = Auth::user()->id;
        $sms->to = $message->from;
        $sms->message = 'system message lawyer <br> appointment payment successfully paid <br> Transaction id is ' . $request->val_id;
        $sms->view = 0;
        $sms->save();

        $lawyer = User::findorFail($message->from);
        $lawyer->balance = $lawyer->balance + $message->appointment_amount;
        $lawyer->save();


        Toastr::success('Message Successfully Send','Success');
        return redirect()->route('message.details',$message->message_id);
    }






}
