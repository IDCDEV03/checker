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
                            $sql_car = DB::table('tran_sport_data')->where('id', '=', $ts_id)->get();
                        @endphp

                        <form action="{{ route('leader_ChkInsert', ['form_id' => request()->form_id,'ts'=>request()->ts]) }}" method="post"
                            name="form2">
                            @csrf


                            <div class="mb-3 row">
                                <label class="col-sm-6 col-form-label">บริษัทขนส่ง :
                                    @foreach ($sql_car as $data)
                                    {{ $data->ts_name }}
                                @endforeach
                                </label>
                              
                            </div>
                   
                            <div class="mb-3 row">
                                <label class="col-sm-2 form-label">ทะเบียนหัว :</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="plate_top" name="plate_top" required>
                              </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 form-label">ทะเบียนหาง :</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="plate_bottom" name="plate_bottom">
                              </div>
                            </div>




                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <caption>ตรวจเมื่อ :: {{ Carbon\Carbon::now()->format('d/m/Y H:i') }} </caption>
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">ข้อตรวจ</th>
                                    <th class="text-center" scope="col" style="font-size: 0.7rem" width="30%">ผลการตรวจ</th>

                                    <th class="text-center" style="font-size: 0.7rem">ข้อบกพร่อง</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = '0';
                                    $n = '0';
                                    $a = '0';
                                @endphp
                                @foreach ($formPreview as $row)
                                <input type="hidden" name="form_type" value="{{$row->form_type}}">
                                    <tr>
                                        <th colspan="5">
                                            หมวดหมู่ {{ $loop->iteration }}
                                            {{ $row->category_name }}</th>

                                    </tr>

                                    @php
                                        $cate_id = $row->category_id;
                                        $sql2 = DB::table('form_choices')->where('category_id', '=', $cate_id)->get();
                                    @endphp
                                    @foreach ($sql2 as $row2)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>{{ $row2->form_choice }}
                                                @if ($row2->choice_img != '0')
                                                    <br>
                                                    <img src="{{ asset('file/' . $row2->choice_img) }}" width="230px"
                                                        height="80px" alt="">
                                                @endif
                                            </td>
                                            @if ($row2->choice_type == '1')
                                            <td>
                                                <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                                <input type="text" class="form-control" name="user_chk[{{ $n++ }}]" ">
                                            </td>
                                           @elseif ($row2->choice_type == '2')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                               <input type="date" class="form-control" name="user_chk[{{ $n++ }}]" ">
                                               <div id="emailHelp" class="form-text">รูปแบบวันที่ ปี ค.ศ.</div>
                                           </td>
                                           @elseif ($row2->choice_type == '3')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                               <input type="text" class="form-control"   name="user_chk[{{ $n++ }}]" maxlength="10">
                                               <div id="emailHelp" class="form-text">ระบุวันที่ วัน/เดือน/ปี พ.ศ. เช่น 11/05/2567</div>
                                           </td>
                                           @elseif ($row2->choice_type == '4')
                                           <td>
                                            <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                            <input type="number" class="form-control" name="user_chk[{{ $n++ }}]" >
                                           
                                        </td>
                                        @elseif ($row2->choice_type == '5')
                                        <td>
                                         <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                         <select name="user_chk[{{ $n++ }}]" class="form-select" >
                                            <option value="1" >ผ่าน</option>
                                            <option value="0" >ไม่ผ่าน</option>       
                                        </select>
                                        
                                     </td>
                                         
                                           @elseif ($row2->choice_type == '6')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                               <select name="user_chk[{{ $n++ }}]" class="form-select" >
                                                    <option value="น้ำมัน" >น้ำมัน </option>
                                                    <option value="NGV" >NGV</option>       
                                                </select>

                                           </td>
                                           @elseif ($row2->choice_type == '7')
                                           <td>
                                               <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                               <select name="user_chk[{{ $n++ }}]" class="form-select" >
                                                    <option value="ปูนผง" >ปูนผง
                                                    </option>
                                                    <option value="ปูนเม็ด" >ปูนเม็ด</option>   
                                                    <option value="ปูนถุง" >ปูนถุง</option>                                                           
                                                </select>

                                           </td>
                                            @endif

                                            <td>
                                                <input class="form-control form-control-sm" type="text"
                                                    name="user_remark[{{ $a++ }}]" placeholder="ข้อบกพร่อง">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td align="center" colspan="2"> สรุปผลการตรวจ </td>
                                    <td colspan="2">
                                     
                                        <select name="final_chk"  class="form-select " >
                                             <option value="1" class="text-success" selected>☑ ผ่าน
                                             </option>
                                             <option value="0" class="text-danger">☒ ไม่ผ่าน</option>                                                      
                                         </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2"> ผู้ตรวจสอบ </td>
                                    <td colspan="2">
                                     
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
