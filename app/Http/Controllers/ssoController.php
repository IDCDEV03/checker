<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ssoController extends Controller
{


    public function index($id, $user, $course, $branch)
    {

                  
        $userRows = DB::table('users')
            ->where('email', '=', $id)
            ->get();

            $idcard = Str::length($id);

            if($course == 'car' AND $idcard == '13')
            {
                $form_id = 'RSRKFOFLAO';
            }elseif($course == 'motobike' AND $idcard == '13')
            {
                $form_id = 'OBRJTWYDQRKGDJU';
            }
            elseif($course == 'trailer' AND $idcard == '13')
            {
                $form_id = 'AMXXUCZTQVQKQZY';
            }elseif($course == 'car' AND $idcard == '8')
            {
                $form_id = 'XNABMYJSCUNQYQ8';
            }

     
        if (count($userRows) == 0) {
            $user_id = Str::upper(Str::random(12));
            User::create([
                'user_id' => $user_id,
                'name' => $user,
                'email' => $id,
                'password' => Hash::make($id),
                'password_2' => $id,
                'role' => 'user',
                'user_dep' => $branch
            ]);

            DB::table('user_forms')->insert([
                    'user_id' => $user_id,
                    'type_form' => $course,
                    'form_id' => $form_id,
                    'user_dep' => $branch,
                    'created_at' => Carbon::now()
                ]);

            DB::table('user_details')->insert([
                'user_id' => $user_id,
                'fullname' => $user,
                'user_logo' => '0',
                'user_status' => '1',
                'user_dep' => $branch, 
                'course_type' => $branch,            
                'created_at' => Carbon::now()
            ]);

        } elseif (count($userRows) >= 1) {
            if (Auth::check()) {
                return view('home');
            }else
            {
                return view('login_sso', ['user' => $id]);
            }
        }
   
        return view('login_sso', ['user' => $id]);
    }

    public function ssoLogin($user)
    {
        return view('login_sso', ['user' => $user]);
    }

    public function ChkDetail($round)
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
        ->select('chk_records.choice_id','chk_records.choice_remark','chk_records.user_chk','chk_records.created_at','form_choices.form_choice','form_choices.choice_img as ch_img','chk_records.choice_img as up_img')   
        ->where('chk_records.round_chk','=',$round)   
        ->get();

        $status_chk = DB::table('truck_data_chks')
        ->select('truck_data_chks.status_chk')
        ->where('truck_data_chks.round_chk', '=', $round)
        ->get();

        $user_dep = DB::table('truck_data_chks')
        ->join('user_details','truck_data_chks.emp_id','=','user_details.user_id')
        ->where('truck_data_chks.round_chk' ,'=', $round )
        ->get();

        return view('ChkDetail',['round' => $round],compact('form_detail','formview','status_chk','user_dep'));
    }
}
