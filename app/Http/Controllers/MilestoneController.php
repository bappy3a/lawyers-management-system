<?php

namespace App\Http\Controllers;

use App\Milestone;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        foreach ($request->date as $key=>$date) {
            $milestone = New Milestone;
            $milestone->hire_id = $request->hire_id;
            $milestone->lawyer_id = $request->lawyer_id;
            $milestone->pay = $request->price[$key];
            $milestone->date = $date;
            $milestone->status = 'Unpaid';
            $milestone->save(); 
        }
        Toastr::success('Milestone Successfully Save','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function show(Milestone $milestone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function edit(Milestone $milestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Milestone $milestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Milestone $milestone)
    {
        //
    }

    /**
     * Fail.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function fail(Request $request)
    {
        $user = User::find($request->value_c);
        auth()->login($user, true);
        return view('paymnetfail');
    }

    /**
     * success.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $user = User::find($request->value_c);
        auth()->login($user, true);

        $milestone = Milestone::findorFail($request->value_b);
        $milestone->status = 'Paid';
        $milestone->save();

        $lawyer = User::findorFail($request->value_a);
        $lawyer->balance = $lawyer->balance + $milestone->pay;
        $lawyer->save();
        Toastr::success('Payment Successfully Paid','Success');
        return redirect()->route('hire.show',$milestone->hare->id);
    }

    /**
     * Fail.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        $milestone = Milestone::findorFail($request->id);
        $lawyer = User::findorFail($milestone->hare->lowyer_id);
        $name = $lawyer->name;
        $price = $milestone->pay;
        $plan_id = $milestone->id;
        $success = route('milestone.pay.success');
        $fail = route('milestone.pay.fail');
        $cancel = route('milestone.pay.fail');
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
        $post_data['value_a'] = $lawyer->id;
        $post_data['value_b'] = $milestone->id;
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




}
