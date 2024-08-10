<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500&display=swap" rel="stylesheet">
    <script>
        window.print();
    </script>
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
            <div class="col-md-8">               
                @if (request()->type == '1')
                    @foreach ($car_data as $item)                           
                        <div class="text-center">
                            <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="100px" alt="">
                        </div>
                        <div class="text-center h5 mb-3"> {{ $item->form_name }}</div>

                        <div class="row mb-3">
                            <div class="col">
                            <span class="col-form-label"><strong>ชื่อผู้บันทึก</strong> : {{ $item->fullname }}</span>
                            </div>

                            <div class="col">                            
                            <span class="col-form-label"><strong>ทะเบียนรถ : </strong>{{ $item->car_plate }} {{ $item->car_province }}</span>                       
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col">
                            <span class="col-form-label"><strong>เลขไมล์</strong> : {{ number_format($item->car_mileage) }}</span>
                            </div>                            
                          </div>
                      
                          @endforeach

                          @elseif(request()->type == '4')

                          @foreach ($car_data as $data)

                          <div class="text-center">
                            <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="100px" alt="">
                        </div>
                        <div class="text-center h5 mb-3">    @foreach ($formName as $row)
                            {{$row->form_name}}
                    @endforeach
</div>

                        <div class="row mb-3">
                            <div class="col">
                            <span class="col-form-label"><strong>ชื่อผู้รับการทดสอบ</strong> :
                                {{ $data->fullname }}</span>
                            </div>

                            <div class="col">                            
                            <span class="col-form-label"><strong>สาขา : </strong>{{ $data->branch_name }}</span>                       
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col">
                            <span class="col-form-label"><strong>โดย</strong> :
                                {{ $data->name }} </span>
                            </div>                            
                          </div>
                               

                            @endforeach

                          @endif
                       
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col col-1">#</th>
                                    <th scope="col col-4">ข้อตรวจ</th>
                                    <th class="text-center col-2">ผลการตรวจ</th>
                                    <th class="text-center col-3">หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formview as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->form_choice }}
                                            <br>
                                        @if ($row->choice_img !== '0')
                                            <img src="{{asset('file/'.$row->choice_img)}}" height="100px" alt="">
                                        @endif
                                        </td>
                                        <td>
                                            @if (request()->type == '4')
                                                    @if ($row->user_chk == '1')
                                                        ผ่าน
                                                    @elseif ($row->user_chk == '0')
                                                        ปรับปรุง
                                                    @endif
                                                @else
                                                    @if ($row->user_chk == '1')
                                                        ปกติ
                                                    @elseif ($row->user_chk == '0')
                                                        ไม่ปกติ
                                                    @elseif ($row->user_chk == '2')
                                                        ไม่มี
                                                    @endif
                                                @endif
                                        </td>
                                        <td>
                                            @if ($row->choice_remark == null)
                                                -
                                            @else
                                                {{ $row->choice_remark }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @foreach ($formchk_date as $item)
                               <td colspan="4" align="center">วันที่ตรวจ : {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                               </td>
                               @endforeach
                              </tfoot>
                        </table>
                        <p class="text-center">
                            @php
                                 $date_now = date("Y-m-d H:i:s");
                            @endphp
                            <strong> Printed On </strong> : ระบบ E-Checker
                            @php echo date("d/m/Y H:i:s", strtotime($date_now)); 
                            @endphp
                    
                        </p> 
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>
