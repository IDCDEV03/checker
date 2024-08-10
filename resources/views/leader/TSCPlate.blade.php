@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">บริษัทขนส่ง
                    
                </div>
                    <div class="card-body">
                        <p class="h4">
                            @foreach ($ts_detail as $row)
                                {{$row->ts_name}} ({{$row->ts_province}})
                          
                        </p>
                        <hr>
<p> 
    <a class="btn btn-sm btn-outline-primary" href="{{route('leader_TypeChk',['id'=>Auth::user()->user_dep,'ts'=>$row->id])}}" role="button">ตรวจรถ</a>
</p>
@endforeach
                        <table class="table table-responsive cell-border" id="dataTables">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th width="20%">ทะเบียนรถ</th>
                                <th>ประเภทรถ</th>
                                <td style="font-size: 10pt" class="fw-bold">จำนวนตรวจ (ครั้ง)</td>
                                <td style="font-size: 10pt" class="fw-bold">วันที่บันทึกข้อมูลล่าสุด</td>
                                <td style="font-size: 10pt" class="fw-bold">สถานะ</td>
                                <td style="font-size: 10pt" class="fw-bold">รายละเอียด</td>
                              </tr>
                            </thead>
                            <tbody>
                               @foreach ($chk_truck as $data)
                           <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                   <td>
                                        {{$data->plate_top}}
                                  </td>
                                  <td> 
                                    @php
   $type_name = DB::table('form_types')->where('id', '=', $data->form_types)->value('form_type_name');;
                                    @endphp
                                 {{$type_name}}
                                  </td>
                                <td align="center"> 
                                    {{$data->sum_chk}}
                                </td>
                                
                                <td>
                                  {{ Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}
                                </td>
                                <td>
                                  @if ($data->status_chk == '1')
                                      ผ่าน
                                  @elseif ($data->status_chk == '0')
                                      ไม่ผ่าน
                                  @endif
                                </td>
                               <td>
                               <a href="{{route('leader_TSCDetail',['round'=>$data->round_chk])}}" class="btn btn-sm btn-primary"> <i class="las la-info-circle"></i></a> 
                               
                               <!--@if ($data->sum_chk >= '3')
                                   <span style="font-size: 10pt" class="text-danger">ตรวจครบแล้ว</span>
                               @else
                               <a class="btn btn-sm btn-success"><i class="las la-check"></i></a>
                               @endif-->
                              
                               </td>
                                                          
                              </tr>
                           
                              @endforeach
                             
                            </tbody>
                          </table>

                      

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
