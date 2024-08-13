<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>E-Checker By ID Drives</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel='icon' href='../images/logo_id.png' type='image/x-icon' sizes="16x16" />
    <!--<script>
        window.print();
    </script>-->
     <style>
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
        }

        .header-space {
            height: 10px;
        }

        .header {
            position: fixed;
            top: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">    
                
                
                <div class="text-center ">
                        @foreach ($user_dep as $item)
                        @php
                            $dep = $item->user_dep;
                            $user_name = $item->fullname;
                        @endphp
                        @endforeach
                    @php
                    $agent_id = $dep;
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
                                {{ $user_name }}</span>
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
                                        <span class="text-danger">ปรับปรุง</span>    
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
                            <span class="text-danger"> ไม่ผ่าน  </span>                                      
                            @endif

                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" class="fw-bold"> ผู้ตรวจสอบ </td>
                        <td colspan="3">
                         
                            <p> {{$user_name}}</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>
