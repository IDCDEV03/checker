<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CompanyConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:company');
    }
    
    //Transport
    public function TransportCreate() {
        return view('company.TransportCreate');
    }

    public function TransportList($id){
     
        $ts_detail = DB::table('tran_sport_data')
        ->where('ts_agent', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('company.TransportList', compact('ts_detail'));
    }

    public function TransportInsert(Request $request)
    {
        $agent_id = Auth::user()->user_id;
        DB::table('tran_sport_data')->insert([
            'ts_agent' => $agent_id,
            'ts_name' => $request->ts_name,
           'ts_address' => $request->ts_address,
           'ts_province' => $request->ts_province,
           'ts_amphur' => $request->ts_amphur,
           'ts_tambon' => $request->ts_tambon,
           'ts_zipcode' => $request->ts_zipcode,
           'ts_phone' => $request->ts_phone,
           'created_at' => Carbon::now()
        ]);

        return redirect()->route('company_TransportList', ['id' => $agent_id])
        ->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function TransportEdit($id){

        $ts_detail = DB::table('tran_sport_data')
        ->where('id', '=', $id)
        ->get();

        return view('company.TransportEdit',['id'=>$id], compact('ts_detail'));

    }

    public function TransportUpdate(Request $request, $id){

        $agent_id = Auth::user()->user_id;

        DB::table('tran_sport_data')
        ->where('id', '=', $id)
        ->update([
            'ts_name' => $request->ts_name,
           'ts_address' => $request->ts_address,
           'ts_province' => $request->ts_province,
           'ts_amphur' => $request->ts_amphur,
           'ts_tambon' => $request->ts_tambon,
           'ts_zipcode' => $request->ts_zipcode,
           'ts_phone' => $request->ts_phone,
           'updated_at' => Carbon::now()
        ]);

        return redirect()->route('company_TransportList', ['id' => $agent_id])
        ->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function ListPlate ($id)
    {

        $ts_detail = DB::table('tran_sport_data')
        ->where('id', '=', $id)
        ->get();

        return view('company.TransportPlateList',['id'=>$id], compact('ts_detail'));
    }

    public function TypeChk ($id,$ts)
    {
        
        $form_list = DB::table('agent_form_lists')
        ->join('form_chks','agent_form_lists.form_id','=','form_chks.form_id')
        ->where('agent_form_lists.agent_id', '=', $id)
        ->get();

        return view('company.TransportTypeChk',['id'=>$id,'ts'=>$ts], compact('form_list'));
    }

    
}
