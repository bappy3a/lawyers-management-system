<?php

namespace App\Http\Controllers;

use App\Cas;
use App\Hare;
use App\Milestone;
use App\HireDetails;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = Cas::latest()->where('user_id',auth()->user()->id)->get();
        return view('client.case.index',compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.case.create');
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
            'case_no'           => 'required|unique:cas',
            'case_title'        => 'required',
            'case_date'         => 'required',
            'court'             => 'required',
            'case_description'  => 'required',
        ]);

        $case = New Cas;
        $case->user_id = Auth::user()->id;
        $case->case_no = $request->case_no;
        $case->court = $request->court;
        $case->case_title = $request->case_title;
        $case->case_date = Carbon::createFromFormat('m/d/Y', $request->case_date)->format('Y-m-d');
        $case->case_description = $request->case_description;
        $case->save();
        if ($case->save()) {
            Toastr::success('Cose Successfully Save','Success');
        }else{
            Toastr::error('Sumthing warning','Error');
        }
        
        return redirect()->route('case.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cas  $cas
     * @return \Illuminate\Http\Response
     */
    public function show(Cas $cas)
    {
        return view('client.case.show',compact('cas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cas  $cas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case = Cas::find($id);
        return view('client.case.edit',compact('case'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cas  $cas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'case_no'           => 'required',
            'case_title'        => 'required',
            'case_date'         => 'required',
            'case_description'  => 'required',
        ]);

        $case = Cas::find($id);
        $case->case_no = $request->case_no;
        $case->case_title = $request->case_title;
        $case->case_date = $request->case_date;
        $case->case_description = $request->case_description;
        $case->save();
        Toastr::success('Cose Successfully updated','Success');
        return redirect()->route('case.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cas  $cas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $case = Cas::find($id);
        $hare = Hare::where('case_id',$id)->first();
        if ($hare) {
            $hare_details = HireDetails::where('hire_id',$hare->id)->get();
            if ($hare_details) {
                foreach ($hare_details as $value) {
                    $value->delete();
                }
            }

            foreach (Milestone::where('hire_id',$hare->id)->get() as $milestone) {
                $milestone->delete();
            }

            $hare->delete();
        }
        
        $case->delete();
        Toastr::success('Cose Successfully delete','Success');
        return back();
    }

    public function active()
    {
        $role = Auth::user()->role;
        if($role == 'client'){
            $hares = Hare::where('client_id',auth()->user()->id)->where('status','runing')->get();
        }else{
            $hares = Hare::where('lowyer_id',auth()->user()->id)->where('status','runing')->get();
        }
        return view('case_report.active',compact('hares'));
    }

    public function complete()
    {
        $role = Auth::user()->role;
        if($role == 'client'){
            $hares = Hare::where('client_id',auth()->user()->id)->where('status','!=' ,'runing')->get();
        }else{
            $hares = Hare::where('lowyer_id',auth()->user()->id)->where('status','!=' ,'runing')->get();
        }
        return view('case_report.complete',compact('hares'));
    }
}
