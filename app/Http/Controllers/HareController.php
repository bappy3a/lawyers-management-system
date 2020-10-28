<?php

namespace App\Http\Controllers;

use App\CaseResult;
use App\Hare;
use App\HireDetails;
use App\Milestone;
use App\Review;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hires = Hare::where('client_id',Auth::user()->id)->latest()->get();
        return view('client.hire.index',compact('hires'));
    }

    public function lawyer_hire()
    {
        $hires = Hare::where('lowyer_id',Auth::user()->id)->latest()->get();
        return view('lawyer.hire.index',compact('hires'));
    }

    public function lawyer_hire_view($id)
    {
        $hire = Hare::find($id);
        return view('lawyer.hire.show',compact('hire'));
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
        $user = User::find($request->value_c);
        auth()->login($user, true);
        $hire = New Hare;
        $hire->client_id = $request->value_c;
        $hire->lowyer_id = $request->value_a;
        $hire->case_id = $request->value_b;
        $hire->hire_date = $request->tran_date;
        $hire->save();

        $lawyer = User::find($request->value_a);
        $milestone = New Milestone;
        $milestone->hire_id = $hire->id;
        $milestone->lawyer_id = $request->value_a;
        $milestone->pay = $lawyer ->rat;
        $milestone->date = $hire->hire_date;
        $milestone->status = 'Paid';
        $milestone->save(); 


        Toastr::success('lowyer Hire & Payment Successfully Complete','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hare  $hare
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hire = Hare::find($id);
        return view('client.hire.show',compact('hire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hare  $hare
     * @return \Illuminate\Http\Response
     */
    public function edit(Hare $hare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hare  $hare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hare $hare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hare  $hare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hare $hare)
    {
        //
    }

    public function harepayment(Request $request){
        $hire = Hare::where('case_id', $request->case_id)->first();
        if ($hire) {
            Toastr::error('lowyer alraday Hire','Error');
            return back();
        }
        $lawyer=User::findorFail($request->lawyer_id);
        $name = $lawyer->name;
        $price = $lawyer->rat;
        $plan_id = $lawyer->id;
        $success = route('hire.store');
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
        $post_data['value_a'] = $lawyer->id;
        $post_data['value_b'] = $request->case_id;
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


    public function hire_details_store(Request $request)
    {
        $details = New HireDetails;
        $details->hire_id = $request->hire_id;
        $details->user_id = auth()->user()->id;
        $details->message = $request->message;

        $documents = array();
        if($request->hasFile('documents')){
            foreach ($request->documents as $document) {
                $path = $document->store('case/details');
                array_push($documents, $path);
            }
            $details->documents = json_encode($documents);
        }
        $details->save();

        Toastr::success('Case Report Successfully Save','Success');
        return back();

    }


    public function complete($id)
    {
        $hire = Hare::find($id);
        $hire->status = 'complete';
        $hire->save();
        Toastr::success('Successfully case complate Save','Success');
        return back();
    }


    public function review(Request $request)
    {
        $review = new Review;
        $review->hire_id = $request->hire_id;
        $review->lowyer_id = $request->lowyer_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        //Lawer Review
        $lawyer = User::find($request->lowyer_id);
        $lawyer->review = Review::where('lowyer_id', $lawyer->id)->sum('rating')/count(Review::where('lowyer_id', $lawyer->id)->get());
            $lawyer->save();
        //Case report
        $hare = Hare::find($request->hire_id);
        $resutl = New CaseResult;
        $resutl->case_id = $hare->case_id;
        $resutl->lawyer_id = $request->lowyer_id;
        if ($request->winorlose == 'win') {
            $resutl->win = 1;
        }else{
            $resutl->lose = 1;
        }
        $resutl->save();
        

        Toastr::success('Review has been submitted successfully','Success');
            return back();
    }



}
