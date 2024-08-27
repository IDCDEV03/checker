<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CompanyReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:company');
    }
    
    public function ReportList($form)
    {
        $agent_id = Auth::user()->user_id;

        $company_list = DB::table('tran_sport_data')
        ->where('ts_agent', '=', $agent_id)
        ->get();

        return view('company.ReportList',compact('company_list'));
    }

}
