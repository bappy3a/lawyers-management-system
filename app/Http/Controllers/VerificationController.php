<?php

namespace App\Http\Controllers;

use App\User;
use App\Verification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Verification::latest()->get();
        return view('admin.verification.index',compact('datas'));

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
        $data = New Verification;
        $data->user_id = Auth::user()->id;
        $data->reg_no = $request->reg_no;
        $data->certificate_2 = $request->certificate_2;

        $photos = array();
        if($request->hasFile('certificate_2')){
            foreach ($request->certificate_2 as $key => $photo) {
                $path = $photo->store('uploads/verification');
                array_push($photos, $path);
            }
            $data->certificate_2 = json_encode($photos);
        }

        $data->status = 'Pending';
        $data->save();
        $this->verification_pay($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Verification::find($id);
        return view('admin.verification.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function edit(Verification $verification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = Verification::find($id);
        $data->reg_no = $request->reg_no;
        $data->certificate_2 = $request->certificate_2;
        $photos = array();
        if($request->hasFile('certificate_2')){
            foreach ($request->certificate_2 as $key => $photo) {
                $path = $photo->store('uploads/verification');
                array_push($photos, $path);
            }
            $data->certificate_2 = json_encode($photos);
        }

        $data->status = 'Pending';
        $data->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verification $verification)
    {
        //
    }

    public function verification_pay($date)
    {
        
        $name = $date->name;
        $price = 500;
        $plan_id = $date->id;
        $success = route('verification.pay.success');
        $fail = route('verification.pay.fail');
        $cancel = route('verification.pay.fail');
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
        $post_data['value_a'] = $date->id;
        $post_data['value_b'] = Auth::user()->id;
        $post_data['value_c'] = '';
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


    public function success_pay(Request $request)
    {
        $user = User::find($request->value_b);
        auth()->login($user, true);
        Toastr::success('Your payment and verification Successfully complate','Success');
       return redirect()->route('profile');
    }

    public function fail_pay(Request $request)
    {
        $user = User::find($request->value_b);
        auth()->login($user, true);
        Verification::find($request->value_a)->delete();
        Toastr::error('Your payment fail','Fail');
       return redirect()->route('profile');
    }

    public function action($id, $type = '')
    {
        $data = Verification::find($id);
        $data->status = $type;
        $data->save();
        if ($type == 'Approved') {
            $user = User::find($data->user_id);
            $user->is_verified = 1;
            $user->reg_no = $data->reg_no;
            $user->certificate_2 = $data->certificate_2;
            $user->save();
        }
        Toastr::success('Verification Successfully Update','Success');
        return back();

    }

}
