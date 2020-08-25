<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function lawyer()
    {
    	$lawyers = User::where('role', 'lawyer')->latest()->get();
    	return view('client.lawyer.index',compact('lawyers'));
    }
    public function lawyer_view($id)
    {
    	$lawyer = User::find($id);
    	return view('client.lawyer.view',compact('lawyer'));
    }
}
