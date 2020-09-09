<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
        	if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }elseif (Auth::user()->role == 'lawyer') {
                return redirect()->route('lawyer.dashboard');
            }elseif (Auth::user()->role == 'client') {
                return redirect()->route('client.dashboard');
            }
        }else{
        	return redirect()->route('login');
        }
    }

    public function lawer_register()
    {
        return view('auth.lawer_register');
    }

    public function lawer_register_save(Request $request)
    {
    	$this->validate($request,[
            'name' 				=> 'required',
            'email' 			=> 'required|email|unique:users',
            'number' 			=> 'required',
            'password'          => 'required|min:8|confirmed|string',
            'chember_address' 	=> 'required',
            'natnal_id' 		=> 'required',
            'lawyer_type'       => 'required',
        ]);

    	$user = New User;
    	$user->name = $request->name;
        $user->role = 'lawyer';
    	$user->email = $request->email;
        $user->lawyer_type = $request->lawyer_type;
    	$user->number = $request->number;
    	$user->password = Hash::make($request->password);
    	$user->chember_address = $request->chember_address;
    	$user->natnal_id = $request->natnal_id;
    	$user->save();
        auth()->login($user, true);
        Toastr::success('Register Successfully','Success');
        return redirect()->route('lawyer.dashboard');
        
    }
    
    public function index()
    {
        return view('home');
    }

    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }

    public function lawyer_dashboard()
    {
        return view('lawyer.dashboard');
    }

    public function client_dashboard()
    {
        return view('client.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user'));
    }
}
