<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function lawyer(Request $request)
    {
        if ($request->s) {

            $req_price = explode(',', $request->price);

            $lawyer_type = $request->lawyer_type;
            $review      = $request->review;
            $price       = end($req_price);
            $is_verified = $request->is_verified;
            $conditions  = ['role' => 'lawyer'];

            if($lawyer_type != null){
                $conditions = array_merge($conditions, ['lawyer_type' => $lawyer_type]);
            }
            if($review != null){
                $conditions = array_merge($conditions, ['review' => $review]);
            }

            if($is_verified != null){
                $conditions = array_merge($conditions, ['is_verified' => $is_verified]);
            }
            $filter = User::where($conditions)->where('rat', '<=', $price);
            $lawyers = $filter->paginate(50)->appends(request()->query());
        }else{
            $lawyers = User::where('role', 'lawyer')->latest()->get();
        };
    	return view('client.lawyer.index',compact('lawyers'));
    }
    public function lawyer_view($id)
    {
    	$lawyer = User::find($id);
    	return view('client.lawyer.view',compact('lawyer'));
    }
}
