<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\chkRecord;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    public function index() 
    {
        $agent_id = Auth::user()->user_dep;

        $dashboard = DB::table('setting_agents')
            ->where('user_id', '=', $agent_id)
            ->get();

        return view('user.index', compact('dashboard'));
    }

    public function FormChk()
    {
        $agent_id = Auth::user()->user_dep;
        $user_id =  Auth::user()->user_id;

        $formChk = DB::table('user_forms')
            ->join('form_chks', 'user_forms.form_id', '=', 'form_chks.form_id')          
            ->select('form_chks.form_name','form_chks.form_category','user_forms.*')
            ->where('user_forms.user_dep', '=', $agent_id)    
            ->where('user_forms.user_id', '=', $user_id)  
            ->get();

        return view('user.formchk', compact('formChk'));
    }

    public function NewFormChk($form_id)
    {
        $agent_id = Auth::user()->user_dep;

        $formPreview = DB::table('form_chks')
            ->select('form_chks.form_id', 'form_chks.form_name', 'form_categories.category_id', 'form_categories.category_name')
            ->join('form_categories', 'form_chks.form_id', '=', 'form_categories.form_id')
            ->where('form_chks.form_id', '=', $form_id)
            ->get();

        $formName = DB::table('form_chks')        
         ->where('form_id', '=', $form_id)
         ->get();

        return view('user.newchk', compact('formPreview', 'formName'));
    }

    public function UserChkInsert(Request $request, $form_id)
    {
        $input = request()->all();
        $condition = $input['choice'];
        $agent_id = Auth::user()->user_dep;
        $user_id =  Auth::user()->user_id;
        $round = Str::upper(Str::random(11));

        DB::table('chk_record_forms')->insert([
            'user_id' => $user_id,
            'car_id' => $request->car_plate,
            'car_mileage' => $request->car_mileage,
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
        return redirect()->route('user_index')->with('success', 'บันทึกสำเร็จ');
    }

    public function ListChk()
    {
        $user_id =  Auth::user()->user_id;

        $chk_record = DB::table('chk_records')
            ->join('form_chks', 'chk_records.form_id', '=', 'form_chks.form_id')
            ->select('chk_records.form_id','chk_records.user_id','chk_records.created_at','form_chks.form_name','chk_records.round_chk')         
            ->where('chk_records.user_id', '=', $user_id)
            ->groupBy('chk_records.round_chk')
            ->get();

        return view('user.list_chk',compact('chk_record'));
    }

    public function FormView($round){

        $formview = DB::table('chk_records')
        ->join('form_choices','chk_records.choice_id','=','form_choices.id')
        ->select('chk_records.choice_id','chk_records.choice_remark','chk_records.user_chk','chk_records.created_at','form_choices.form_choice','form_choices.choice_img')   
        ->where('chk_records.round_chk','=',$round)   
        ->get();

        $formchk_date = DB::table('chk_records')
        ->select('chk_records.created_at','chk_records.round_chk')  
        ->where('chk_records.round_chk','=',$round)
        ->orderBy('id', 'asc')  
        ->limit(1) 
        ->get();

        $car_data = DB::table('chk_record_forms')
        ->join('form_car_datas','chk_record_forms.car_id','=','form_car_datas.id')
        ->join('form_chks','form_car_datas.form_id','=','form_chks.form_id')
        ->select('form_car_datas.car_plate','form_car_datas.car_province','form_car_datas.car_type','form_chks.form_name','chk_record_forms.car_mileage')
        ->where('chk_record_forms.round_chk','=',$round)
        ->get();

        return view('user.formchkView',['round'=>$round],compact('formview','formchk_date','car_data'));
    }

    public function preview_print($round)
    {  

        $formview = DB::table('chk_records')
        ->join('form_choices','chk_records.choice_id','=','form_choices.id')
        ->select('chk_records.choice_id','chk_records.choice_remark','chk_records.user_chk','chk_records.created_at','form_choices.form_choice','form_choices.choice_img')   
        ->where('chk_records.round_chk','=',$round)   
        ->get();

        $formchk_date = DB::table('chk_records')
        ->select('chk_records.created_at','chk_records.round_chk')  
        ->where('chk_records.round_chk','=',$round)
        ->orderBy('id', 'asc')  
        ->limit(1) 
        ->get();

        $car_data = DB::table('chk_record_forms')
        ->join('form_car_datas','chk_record_forms.car_id','=','form_car_datas.id')
        ->join('form_chks','form_car_datas.form_id','=','form_chks.form_id')
        ->select('form_car_datas.car_plate','form_car_datas.car_province','form_car_datas.car_type','form_chks.form_name','chk_record_forms.car_mileage')
        ->where('chk_record_forms.round_chk','=',$round)
        ->get();

       return view('user.preview_form_print',['round'=>$round],compact('formview','formchk_date','car_data'));
    }

}
