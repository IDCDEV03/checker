<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:leader');
    }

    public function index()
    {
        $agent_id = Auth::user()->user_dep;
        $user_role = Auth::user()->role;
        $user_id =  Auth::user()->user_id;

        $user_detail = DB::table('user_details')
            ->where('user_id', '=', $user_id)
            ->get();
  

        $form_list = DB::table('agent_form_lists')
            ->join('form_chks', 'agent_form_lists.form_id', '=', 'form_chks.form_id')
            ->select('form_chks.form_name', 'form_chks.form_type', 'form_chks.form_category', 'agent_form_lists.*')
            ->where('agent_form_lists.agent_id', '=', $agent_id)
            ->where('agent_form_lists.leader_role', '=', '1')
            ->get();

        return view('leader.index', compact('user_detail', 'form_list'));
    }

    public function NewChk($form_id)
    {
        $formPreview = DB::table('form_chks')
            ->select('form_chks.form_id', 'form_chks.form_name', 'form_categories.category_id', 'form_categories.category_name', 'form_chks.form_type')
            ->join('form_categories', 'form_chks.form_id', '=', 'form_categories.form_id')
            ->where('form_chks.form_id', '=', $form_id)
            ->get();

        $formName = DB::table('form_chks')
            ->where('form_id', '=', $form_id)
            ->get();

        return view('leader.FormChk', ['form_id' => $form_id], compact('formPreview', 'formName'));
    }

    public function ChkInsert(Request $request, $form_id, $ts)
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
            'form_types' => $request->form_type,
            'status_chk' => $request->final_chk,
            'round_chk' => $round,
            'created_at' => Carbon::now()
        ]);

        foreach ($condition as $key => $condition) {
            DB::table('chk_records')->insert([
                'agent_id' => $agent_id,
                'user_id' => $user_id,
                'form_id' => $form_id,
                'choice_id' => $input['choice'][$key],
                'user_chk' => $input['user_chk'][$key],
                'round_chk' => $round,
                'choice_remark' => $input['user_remark'][$key],
                'created_at' => Carbon::now()
            ]);
        }

     
        return redirect()->route('leader_Plate', ['id'=>$ts])->with('success', 'บันทึกข้อมูลสำเร็จ');

    }

    public function ListForm($form_id, $form_type)
    {
        $agent_id = Auth::user()->user_id;

        if ($form_type == '4') {
            $formName = DB::table('form_chks')
                ->where('form_id', '=', $form_id)
                ->get();

            $record_data = DB::table('detail_records')
                ->join('user_details', 'detail_records.std_id', '=', 'user_details.user_id')
                ->join('form_chks', 'detail_records.form_id_chk', '=', 'form_chks.form_id')
                ->select('detail_records.round_chk', 'form_chks.form_type', 'form_chks.form_name', 'user_details.fullname', 'detail_records.created_at')
                ->where('detail_records.form_id_chk', '=', $form_id)
                ->where('detail_records.user_id', '=', $agent_id)
                ->orderByDesc('detail_records.created_at')
                ->get();
        } else {

            $formName = DB::table('form_chks')
                ->where('form_id', '=', $form_id)
                ->get();

            $record_data = DB::table('chk_records')
                ->join('form_chks', 'chk_records.form_id', '=', 'form_chks.form_id')
                ->join('user_details', 'chk_records.user_id', '=', 'user_details.user_id')
                ->select('chk_records.round_chk', 'form_chks.form_type', 'form_chks.form_name', 'user_details.fullname', 'chk_records.created_at')
                ->where('chk_records.form_id', '=', $form_id)
                ->where('user_details.user_id', '=', $agent_id)
                ->groupBy('chk_records.round_chk')
                ->get();
        }

        return view('leader.ListForm', compact('record_data', 'formName'));
    }

    public function DetailChk($round, $type)
    {

        $formchk_date = DB::table('chk_records')
            ->select('chk_records.created_at', 'chk_records.round_chk')
            ->where('chk_records.round_chk', '=', $round)
            ->orderBy('id', 'asc')
            ->limit(1)
            ->get();

        $formview = DB::table('chk_records')
            ->join('form_choices', 'chk_records.choice_id', '=', 'form_choices.id')
            ->select('chk_records.choice_id', 'chk_records.choice_remark', 'chk_records.user_chk', 'chk_records.created_at', 'form_choices.form_choice', 'form_choices.choice_img')
            ->where('chk_records.round_chk', '=', $round)
            ->get();

        if ($type == '4') {
            $form_id = DB::table('detail_records')
                ->where('round_chk', '=', $round)
                ->value('form_id_chk');

            $formName = DB::table('form_chks')
                ->where('form_id', '=', $form_id)
                ->get();

            $DetailData = DB::table('detail_records')
                ->join('user_details', 'detail_records.std_id', '=', 'user_details.user_id')
                ->join('branch_names', 'detail_records.user_dep', '=', 'branch_names.id_branch')
                ->where('detail_records.round_chk', '=', $round)
                ->get();
        } else {
            $form_id = DB::table('chk_records')
                ->where('round_chk', '=', $round)
                ->value('form_id');

            $formName = DB::table('form_chks')
                ->where('form_id', '=', $form_id)
                ->get();

            $DetailData = DB::table('chk_record_forms')
                ->join('user_details', 'chk_record_forms.user_id', '=', 'user_details.user_id')
                ->join('form_car_datas', 'chk_record_forms.car_id', '=', 'form_car_datas.id')
                ->join('form_chks', 'form_car_datas.form_id', '=', 'form_chks.form_id')
                ->select('form_car_datas.car_plate', 'form_car_datas.car_province', 'form_car_datas.car_type', 'form_chks.form_name', 'chk_record_forms.car_mileage')
                ->where('chk_record_forms.round_chk', '=', $round)
                ->get();
        }

        return view('leader.DetailChk', ['round' => $round, 'type' => $type], compact('formview', 'formchk_date', 'formName', 'DetailData'));
    }

    public function ReportAllPlate ()
    {
        return view('leader.Report_AllPlate');
    }
}
