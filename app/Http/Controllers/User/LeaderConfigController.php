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

        $id_max = DB::table('truck_data_chks')->select(DB::raw('MAX(id)'))
        ->groupBy('plate_top');

        $chk_truck = DB::table('truck_data_chks')
        ->orderBy('id', 'DESC')
        ->where('ts_agent','=',$id)
        ->whereIn('id',$id_max)
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
//ตรวจครั้งที่1
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

    //ตรวจครั้งที่ 2

    public function TSCChk2($form_id,$ts,$round,$num)
    {
        $zero_chk = '0';
        $formPreview = DB::table('truck_data_chks')   
            ->join('chk_records' , 'truck_data_chks.round_chk', '=' ,'chk_records.round_chk')
            ->join('form_choices' ,'chk_records.choice_id' ,'=' ,'form_choices.id')
            ->join('form_types', 'truck_data_chks.form_types', '=' ,'form_types.id')
            ->join('form_categories', 'form_choices.category_id', '=', 'form_categories.category_id')
            ->select('form_choice','choice_remark','form_types','plate_top','form_type_name','category_name','form_categories.category_id','choice_type','chk_records.choice_img','chk_records.choice_remark','form_choices.id')
            ->where('chk_records.user_chk','=',$zero_chk)
            ->where('truck_data_chks.round_chk', '=', $round)            
            ->get();
            
        $formName = DB::table('form_chks')
            ->where('form_id', '=', $form_id)
            ->get();

        return view('leader.TSCCheck2', ['form_id' => $form_id,'ts'=>$ts,'round'=>$round,'num'=>$num], compact('formPreview', 'formName'));
    }

    public function TSCDetail ($round)
    {

        $form_detail = DB::table('truck_data_chks')
        ->join('form_chks','truck_data_chks.form_chk','=','form_chks.form_id')
        ->join('form_types','form_chks.form_type','=','form_types.id')
        ->join('tran_sport_data','truck_data_chks.ts_agent','=','tran_sport_data.id')
        ->select('truck_data_chks.plate_top','truck_data_chks.plate_bottom','truck_data_chks.created_at','form_chks.form_name','form_types.form_type_name','tran_sport_data.ts_name','truck_data_chks.chk_num','truck_data_chks.created_at')
        ->where('truck_data_chks.round_chk', '=', $round)
        ->get();

        $formview = DB::table('chk_records')
        ->join('form_choices','chk_records.choice_id','=','form_choices.id')
        ->select('chk_records.choice_id','chk_records.choice_remark','chk_records.user_chk','chk_records.created_at','form_choices.form_choice','form_choices.choice_img')   
        ->where('chk_records.round_chk','=',$round)   
        ->get();

        $status_chk = DB::table('truck_data_chks')
        ->select('truck_data_chks.status_chk')
        ->where('truck_data_chks.round_chk', '=', $round)
        ->get();

        return view('leader.TSCDetail', ['round' => $round],compact('form_detail','formview','status_chk'));
    }

    public function chkinsert2(Request $request, $form_id, $ts)
    {
        $input = request()->all();
        $condition = $input['choice'];
        $agent_id = Auth::user()->user_dep;
        $user_id =  Auth::user()->user_id;
        $round = Str::upper(Str::random(11));

        DB::table('truck_data_chks')->insert([
            'emp_id' => $user_id,
            'ts_agent' => $ts,
            'form_chk' => $form_id,
            'plate_top' => $request->plate_top,
            'plate_bottom' => $request->plate_bottom,
            'chk_num' => '2',
            'form_types' => $request->form_type,
            'status_chk' => $request->final_chk,
            'round_chk' => $round,
            'created_at' => Carbon::now()
        ]);
       
        foreach ($condition as $key => $condition) {

            $choice_img = $input['choice_img'][$key];
            $choice_id = $input['choice'][$key];
            $fileOriginalName = $choice_img->getClientOriginalExtension();
            $fileNewName = $form_id.'_'.$choice_id.'_'.time() .'.'. $fileOriginalName;
            $upload_location = 'upload/';
            $full_path = $upload_location . $fileNewName;

            $choice_img->move($upload_location, $fileNewName);

            DB::table('chk_records')->insert([
                'agent_id' => $agent_id,
                'user_id' => $user_id,
                'form_id' => $form_id,
                'choice_id' => $input['choice'][$key],
                'user_chk' => $input['user_chk'][$key],
                'round_chk' => $round,
                'choice_remark' => $input['user_remark'][$key],
                'choice_img' => $full_path,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->route('leader_Plate', ['id'=>$ts])->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function ListPlate_all ($plate,$id)
    {
        $chk_truck = DB::table('truck_data_chks')
        ->where('plate_top', '=', $plate)
        ->orderBy('id', 'ASC')
        ->get();
             
        $ts_detail = DB::table('tran_sport_data')
        ->where('id', '=', $id)
        ->get();
 
      return view('leader.TSCChkNum', ['plate' => $plate,'id'=>$id],compact('chk_truck','ts_detail'));
    }



}
