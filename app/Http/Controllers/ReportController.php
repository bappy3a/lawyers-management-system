<?php

namespace App\Http\Controllers;

use App\Cas;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function lawyer()
    {
    	$lawyers = User::where('role','lawyer')->latest()->get();
    	return view('admin.report.lawyer',compact('lawyers'));
    }
    public function financial()
    {
    	return view('admin.report.financial');
    }
    public function case()
    {
    	$cases = Cas::latest()->get();
    	return view('admin.report.case',compact('cases'));
    }
}
