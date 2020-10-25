<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function lawyer()
    {
    	$lawyers = User::where('role', 'lawyer')->latest()->get();
    	return view('admin.lawyer.index',compact('lawyers'));
    }
    public function lawyer_view($id)
    {
    	$lawyer = User::find($id);
    	return view('admin.lawyer.view',compact('lawyer'));
    }

    public function client()
    {
        $lawyers = User::where('role', 'client')->latest()->get();
        return view('admin.lawyer.cleint',compact('lawyers'));
    }
}
