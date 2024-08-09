@extends('layouts.userapp')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                    @foreach ($car_data as $item)    
                        <a class="btn btn-primary mb-2" href="{{route('user_printpreview',['round'=>request()->round])}}" target="_blank"><i class="las la-print"></i> พิมพ์</a>
                        <div class="text-center">
                            <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="100px" alt="">
                        </div>
                        <div class="text-center h5 mb-3"> {{ $item->form_name }}</div>

                        <div class="row mb-3">
                            <div class="col">
                            <span class="col-form-label"><strong>ชื่อผู้บันทึก</strong> : {{Auth::user()->name}}</span>
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
                        <div class="table-responsive-md">
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
                                        @if ($row->choice_img !== '0')
                                            <img src="{{asset($row->choice_img)}}" height="60px" alt="">
                                        @endif
                                        </td>
                                        <td>
                                            @if ($row->user_chk == '1')
                                                ปกติ
                                            @elseif ($row->user_chk == '0')
                                                ไม่ปกติ
                                            @elseif ($row->user_chk == '2')
                                                ไม่มี
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
