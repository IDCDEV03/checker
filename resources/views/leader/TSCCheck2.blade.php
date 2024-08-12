@extends('layouts.leaderapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
@php
$sql_logo = DB::table('user_details')->where('user_details.user_id', '=', Auth::user()->user_dep)->value('user_logo');
@endphp
                            @if ($sql_logo != '0')
                            <img src="{{ asset($sql_logo) }}" class="mb-2" height="50px" alt="">  
                            @endif
                             <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="80px" alt="">
                            
                        </div>
                        @foreach ($formName as $row)
                            <div class="text-center fs-4 mb-3 fw-bold">
                                {{ $row->form_name }}
                            </div>
                        @endforeach
                        @php
                            $form_id = request()->form_id;
                            $ts_id = request()->ts;
                            $round = request()->round;
                            $sql_car = DB::table('tran_sport_data')->where('id', '=', $ts_id)->get();
                            $car_data = DB::table('truck_data_chks')->where('round_chk', '=', $round)->value('plate_top');
                            @endphp
                        <form action="{{ route('leader_chkinsert2', ['form_id' => request()->form_id,'ts'=>request()->ts]) }}" method="post"
                            name="form2" enctype="multipart/form-data">
                            @csrf


                            <div class="mb-3 row">
                                <label class="col-sm-6 col-form-label fw-bold">บริษัทขนส่ง :
                                    @foreach ($sql_car as $data)
                                    {{ $data->ts_name }}
                                @endforeach
                                </label>
                              
                            </div>
                   
                            <div class="mb-3 row">
                                <label class="col-sm-2 form-label fw-bold">ทะเบียนหัว :</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="plate_top" name="plate_top" value="{{$car_data}}" readonly>
                              </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 form-label fw-bold">ทะเบียนหาง :</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="plate_bottom" name="plate_bottom">
                              </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 form-label fw-bold">ตรวจครั้งที่ 1 วันที่:</label>
                                <div class="col-sm-6">
                               <span> @foreach ($sql_car as $item)
                                  {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                               @endforeach</span>
                                   
                                </div>                                
                            </div>
                            
                            <div class="mb-3 row">                            
                                <div class="col-sm-6">
                                    <span class="badge bg-primary" style="font-size: 16px">ตรวจครั้งที่  {{request()->num}} </span>
                                </div>
                                
                            </div>

                        




                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <caption>วันที่และเวลาตรวจ :: {{ Carbon\Carbon::now()->format('d/m/Y H:i') }} </caption>
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">ข้อตรวจ</th>
                                    <th class="text-center" style="font-size: 0.7rem" width="20%">ข้อบกพร่อง</th>
                                    <th class="text-center" scope="col" style="font-size: 0.7rem" 
                                    width="30%">ผลการตรวจ</th>

                                 
                                    <th width="20%">ภาพถ่าย</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = '0';
                                    $n = '0';
                                    $a = '0';
                                    $m = '0';
                                @endphp
                                @foreach ($formPreview as $row)
                                <input type="hidden" name="form_type" value="{{$row->form_types}}">
                                    <tr>
                                        <th colspan="5">
                                            หมวดหมู่ {{ $loop->iteration }}
                                            {{ $row->category_name }}</th>

                                    </tr>

                                    @php
                                        $cate_id = $row->category_id;
                                        $sql2 = DB::table('form_choices')->where('category_id', '=', $cate_id)->get();
                                    @endphp
                                   
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>{{ $row->form_choice }}
                                                @if ($row->choice_img != '0')
                                                    <br>
                                                    <img src="{{ asset('file/' . $row->choice_img) }}" width="230px"
                                                        height="80px" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-danger">{{$row->choice_remark}}</p>
                                                <input class="form-control form-control-sm" type="text"
                                                    name="user_remark[{{ $a++ }}]" placeholder="ข้อบกพร่อง">
                                            </td>

                                            @if ($row->choice_type == '1')
                                            <td>
                                                <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                                <input type="text" class="form-control" name="user_chk[{{ $n++ }}]" ">
                                            </td>
                                           @elseif ($row->choice_type == '2')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                               <input type="date" class="form-control" name="user_chk[{{ $n++ }}]" ">
                                               <div id="emailHelp" class="form-text">รูปแบบวันที่ ปี ค.ศ.</div>
                                           </td>
                                           @elseif ($row->choice_type == '3')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                               <input type="text" class="form-control"   name="user_chk[{{ $n++ }}]" maxlength="10">
                                               <div id="emailHelp" class="form-text">ระบุวันที่ วัน/เดือน/ปี พ.ศ. เช่น 11/05/2567</div>
                                           </td>
                                           @elseif ($row->choice_type == '4')
                                           <td>
                                            <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                            <input type="number" class="form-control" name="user_chk[{{ $n++ }}]" >
                                           
                                        </td>
                                        @elseif ($row->choice_type == '5')
                                        <td>
                                         <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                         <select name="user_chk[{{ $n++ }}]" class="form-select" >
                                            <option value="1" >ผ่าน</option>
                                            <option value="0" >ไม่ผ่าน</option>       
                                        </select>
                                        
                                     </td>
                                         
                                           @elseif ($row->choice_type == '6')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                               <select name="user_chk[{{ $n++ }}]" class="form-select" >
                                                    <option value="น้ำมัน" >น้ำมัน </option>
                                                    <option value="NGV" >NGV</option>       
                                                </select>

                                           </td>
                                           @elseif ($row->choice_type == '7')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row->id }}">

                                               <select name="user_chk[{{ $n++ }}]" class="form-select" >
                                                    <option value="ปูนผง" >ปูนผง
                                                    </option>
                                                    <option value="ปูนเม็ด" >ปูนเม็ด</option>   
                                                    <option value="ปูนถุง" >ปูนถุง</option>                                                           
                                                </select>

                                           </td>
                                            @endif

                                         
                                            <td>
                                                
                                                    <input class="form-control form-control-sm" id="formFileSm" name="choice_img[{{ $m++ }}]" type="file" accept="image/*" required>
                                             
                                            </td>
                                         
                                        </tr>
                                    @endforeach
                              
                                <tr>
                                    <td align="center" colspan="2" class="fw-bold"> สรุปผลการตรวจ </td>
                                    <td colspan="3">
                                     
                                        <select name="final_chk"  class="form-select " >
                                             <option value="1" class="text-success" selected>☑ ผ่าน
                                             </option>
                                             <option value="0" class="text-danger">☒ ไม่ผ่าน</option>                                                      
                                         </select>

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
                        </table>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".js-example").select2({
                placeholder: "--เลือก",
                allowClear: true
            });
        });
    </script>

@endsection
