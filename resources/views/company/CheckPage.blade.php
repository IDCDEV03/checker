@extends('layouts.companyapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="100px" alt="">
                        </div>
                        @foreach ($formName as $row)
                            <div class="text-center h5 mb-3"> 
                                {{ $row->form_name }}
                            </div>
                        @endforeach
                        @php
                            $form_id = request()->form_id;
                            $ts_id = request()->ts;
                            $sql_car = DB::table('tran_sport_data')
                                ->where('id', '=', $ts_id)
                                ->get();
                        @endphp

                        <form action="{{ route('user_ChkInsert', ['form_id' => request()->form_id]) }}" method="post"
                            name="form2">
                            @csrf
                       
                            <div class="mb-3 row">
                                <label class="col-sm-6 col-form-label">บริษัทขนส่ง :
                                    @foreach ($sql_car as $data)
                                    {{ $data->ts_name }}
                                @endforeach
                                </label>
                              
                            </div>
                     
                   
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <caption>ตรวจเมื่อ :: {{ Carbon\Carbon::now()->format('d/m/Y H:i') }} </caption>
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">ข้อตรวจ</th>
                                        <th class="text-center" scope="col" style="font-size: 0.7rem">ผลการตรวจ</th>

                                        <th class="text-center" style="font-size: 0.7rem">ข้อพกพร่อง</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i = '0';
                                        $n = '0';
                                        $a = '0';
                                    @endphp
                                    @foreach ($formPreview as $row)
                                        <tr>
                                            <th colspan="5">
                                                หมวดหมู่ {{ $loop->iteration }}
                                                {{ $row->category_name }}</th>

                                        </tr>

                                        @php
                                            $cate_id = $row->category_id;
                                            $sql2 = DB::table('form_choices')
                                                ->where('category_id', '=', $cate_id)
                                                ->get();
                                        @endphp
                                        @foreach ($sql2 as $row2)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td>{{ $row2->form_choice }}
                                                    @if ($row2->choice_img != '0')
                                                        <br>
                                                        <img src="{{ asset('file/'.$row2->choice_img) }}" width="230px"
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
                                               </td>
                                               @elseif ($row2->choice_type == '3')
                                               <td>
                                                   <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                                   <input type="number" class="form-control" name="user_chk[{{ $n++ }}]" ">
                                               </td>
                                               @elseif ($row2->choice_type == '4')
                                               <td>
                                                   <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $row2->id }}">

                                                   <select name="user_chk[{{ $n++ }}]"
                                                        class="form-select form-control " size="3">
                                                        <option value="1" class="text-success" selected>☑ ผ่าน
                                                        </option>
                                                        <option value="0" class="text-danger">☒ ไม่ผ่าน</option>                                                      
                                                    </select>

                                               </td>
                                                @endif
                                              

                                                <td>
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="user_remark[{{ $a++ }}]" placeholder="ข้อพกพร่อง">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
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


 
@endsection
