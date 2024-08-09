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
}
