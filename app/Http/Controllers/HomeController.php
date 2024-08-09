<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function preview_print($round,$type)
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

        if($type == '4')
        {
            $form_id = DB::table('detail_records')
            ->where('round_chk', '=', $round)
            ->value('form_id_chk');

            $formName = DB::table('form_chks')
            ->where('form_id', '=', $form_id)
            ->get();

            $car_data = DB::table('detail_records')
            ->join('user_details', 'detail_records.std_id', '=', 'user_details.user_id')
            ->join('users', 'detail_records.user_id', '=', 'users.user_id')
            ->join('branch_names','detail_records.user_dep','=','branch_names.id_branch')
            ->where('detail_records.round_chk', '=', $round)
            ->get();
        }else
        {

            $form_id = DB::table('detail_records')
            ->where('round_chk', '=', $round)
            ->value('form_id_chk');

            $formName = DB::table('form_chks')
            ->where('form_id', '=', $form_id)
            ->get();

        $car_data = DB::table('chk_record_forms')
        ->join('form_car_datas','chk_record_forms.car_id','=','form_car_datas.id')
        ->join('user_details', 'chk_record_forms.user_id', '=', 'user_details.user_id')
        ->join('form_chks','form_car_datas.form_id','=','form_chks.form_id')
        ->select('form_car_datas.car_plate','form_car_datas.car_province','form_car_datas.car_type','form_chks.form_name','chk_record_forms.car_mileage','user_details.fullname')
        ->where('chk_record_forms.round_chk','=',$round)
        ->get();

        }

       return view('preview_form_print',['round'=>$round],compact('formview','formchk_date','car_data','formName'));
    }
}
