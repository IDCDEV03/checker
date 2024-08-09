<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class LeaderConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:leader');
    }

    public function TransportList($id){
     
        $ts_detail = DB::table('tran_sport_data')
        ->where('ts_agent', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('leader.TSCList', compact('ts_detail'));
    }

    public function ListPlate ($id)
    {

        $ts_detail = DB::table('tran_sport_data')
        ->where('id', '=', $id)
        ->get();

        $chk_truck = DB::table('truck_data_chks')
        ->selectRaw('*, sum(chk_num) as sum_chk')
        ->groupBy('plate_top')
        ->orderBy('id', 'DESC')
        ->where('ts_agent','=',$id)
        ->get();

        return view('leader.TSCPlate',['id'=>$id], compact('ts_detail','chk_truck'));
    }

    public function TypeChk ($id,$ts)
    {
        
        $form_list = DB::table('agent_form_lists')
        ->join('form_chks','agent_form_lists.form_id','=','form_chks.form_id')
        ->where('agent_form_lists.agent_id', '=', $id)
        ->get();

        return view('leader.TSCTypeChk',['id'=>$id,'ts'=>$ts], compact('form_list'));
    }

    public function TSCChk($form_id)
    {
        $formPreview = DB::table('form_chks')
            ->select('form_chks.form_id', 'form_chks.form_name', 'form_categories.category_id', 'form_categories.category_name', 'form_chks.form_type')
            ->join('form_categories', 'form_chks.form_id', '=', 'form_categories.form_id')
            ->where('form_chks.form_id', '=', $form_id)
            ->get();

        $formName = DB::table('form_chks')
            ->where('form_id', '=', $form_id)
            ->get();

        return view('leader.TSCCheck', ['form_id' => $form_id], compact('formPreview', 'formName'));
    }

}
