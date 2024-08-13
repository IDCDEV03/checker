<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\truck_data_chk;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class QRcodeGenerateController extends Controller
{
    public function qrcode($round)
    {
        
        $URL = 'https://sitchecker.iddrives.co.th/chkdetail/'.$round;
        $qrCodes = [];
        $qrCodes['simple'] = QrCode::size(250)->generate($URL);
        
        
        $truck_data = DB::table('truck_data_chks')
        ->join('tran_sport_data','truck_data_chks.ts_agent','=','tran_sport_data.id')
        ->select('plate_top','chk_num','ts_name','truck_data_chks.created_at')
        ->where('truck_data_chks.round_chk', '=', $round)
        ->get();

        return view('leader.qrcode',$qrCodes,compact('truck_data'));
    
    }
}
