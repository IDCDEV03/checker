@extends('layouts.leaderapp')

@section('content')


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

               

                <div class="card">

                    <div class="card-body">
                   
                            <a class="btn btn-primary mb-2 printPage" id="printPage" href="#" target="_blank"><i class="las la-print"></i>
                                พิมพ์</a>
                            <div class="text-center ">
                                @php
                                $agent_id = Auth::user()->user_dep;
                                $company_logo = DB::table('user_details')                            
                                    ->where('user_details.user_id', '=', $agent_id)
                                    ->get();
                                @endphp
                                @foreach ($company_logo as $data)
                                @if ($data->user_logo != '0')
                                <img src="{{ asset($data->user_logo) }}" alt="..." height="60px">
                                @endif
                                @endforeach
                                <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="80px" alt="">
                            </div>
                            <div class="text-center h4 fw-bold mb-3">
                                @foreach ($form_detail as $row)
                                    {{ $row->form_name }}
                           
                            </div>
                           
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="col-form-label"><strong>ทะเบียนรถ </strong> :
                                            {{$row->plate_top}}</span>
                                    </div>

                                    <div class="col">
                                        <span class="col-form-label"><strong>ประเภทรถ : </strong>
                                        {{$row->form_type_name}}
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="col-form-label"><strong>โดย</strong> :
                                            {{ Auth::user()->name }}</span>
                                    </div>

                                    <div class="col">
                                        <span class="col-form-label"><strong>บริษัทขนส่ง : </strong> {{$row->ts_name}} </span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="col-form-label"><strong>ตรวจครั้งที่</strong> :
                                            {{ $row->chk_num }}</span>
                                    </div>

                                    <div class="col">
                                        <span class="col-form-label"><strong>วันที่และเวลาตรวจ : </strong> {{ Carbon\Carbon::parse($row->created_at)->format('d/m/Y H:i') }} </span>
                                    </div>
                                </div>
                       
                       
                                @endforeach
                        <div class="table-responsive-md">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col col-1">#</th>
                                        <th scope="col col-4">ข้อตรวจ</th>
                                        <th class="text-center col-2" width="20%">ผลการตรวจ</th>
                                        <th class="text-center col-3" width="20%">ข้อบกพร่อง</th>
                                     <th>ภาพถ่าย</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formview as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->form_choice }}
                                            <br>
                                        @if ($row->ch_img !== '0')
                                            <img src="{{asset($row->ch_img)}}" height="100px" alt="">
                                        @endif
                                        </td>
                                        <td align="center">
                                             @if ($row->user_chk == '1')
                                                        ผ่าน
                                              @elseif ($row->user_chk == '0')
                                                        ปรับปรุง
                                            @else
                                            {{$row->user_chk}}
                                              @endif
                                              
                                        </td>
                                        <td>
                                            @if ($row->choice_remark == null)
                                                -
                                            @else
                                                {{ $row->choice_remark }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->up_img !== '0')
                                            <img src="{{asset($row->up_img)}}" height="100px" alt="">
                                            @else
                                            -
                                        @endif
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                <tr>
                                    <td align="center" colspan="2" class="fw-bold"> สรุปผลการตรวจ </td>
                                    <td colspan="3" >
                                     @foreach ($status_chk as $data)
                                       @if ($data->status_chk == '1')
                                            ผ่าน
                                        @elseif ($data->status_chk == '0')
                                        ไม่ผ่าน                                        
                                        @endif

                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2" class="fw-bold"> ผู้ตรวจสอบ </td>
                                    <td colspan="3">
                                     
                                        <p> {{Auth::user()->name}}</p>
<span>
(............................................................)</span>
                                    </td>
                                </tr>
                                </tbody>
                              <tfoot>
                                    @foreach ($form_detail as $item)
                                        <td colspan="5" align="center">ตรวจสอบวันที่ :
                                            {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                    @endforeach
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        $('a.printPage').click(function(){
             $('#report-summary').show();
                window.print();
                return false;
     });
    </script>

@endsection
