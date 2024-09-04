@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    @php
                    $i = '0';
                    $n = '0';
                    $a = '0';
                    $m = '0';

                    $cate_id = request()->category_id;
                    $category_name = DB::table('form_categories')
                        ->where('category_id', '=', $cate_id)
                        ->value('category_name');

                    $form = request()->form;       
                    $form_name = DB::table('form_chks') 
                    ->where('form_id','=',$form)      
                    ->value('form_name');

                    $category_count = DB::table('form_categories')
                    ->where('form_id','=',$form)
                    ->count();

                    $num_count = request()->num;

                      
                          $cate_id_total = DB::table('form_categories')
                            ->where('category_id', '=', $cate_id)
                            ->value('id');    

                        $sum_cate_id = ($cate_id_total+1);

                        $cate_id_plus = DB::table('form_categories')
                            ->where('id', '=', $sum_cate_id)
                            ->value('category_id');    

                            $cate_sum = ($num_count+1);  
                      
                     @endphp
                    <div class="card-header">ตรวจรถส่วนที่ 2 {{$form_name}} (หมวดหมู่ที่ {{request()->num}} จาก {{$category_count}})</div>

                    <div class="card-body">                                   
                        <p class="fw-bold fs-4">หมวดหมู่ : {{ $category_name }} </p>
                        <hr>

 <form action="{{route('leader_TruckInsert2')}}" method="POST" enctype="multipart/form-data">
    @csrf
 
 <input type="hidden" name="form_id" value="{{$form}}">
 <input type="hidden" name="round" value="{{request()->round}}">
 <input type="hidden" name="truckid" value="{{request()->id}}">
 <input type="hidden" name="num" value="{{$cate_sum}}">
 <input type="hidden" name="category_id" value="{{$cate_id_plus}}">


                            @foreach ($category1 as $data)
                                <div class="mb-3">
                                    <label class="form-label fw-bold fs-5">{{ $loop->iteration }}. {{$data->form_choice}}</label>
@if ($data->choice_img == '0')    
@else
    <img src="{{asset('file/'.$data->choice_img)}}" width="100%" class="img-thumbnail">
@endif
                                    <div id="emailHelp" class="form-text">ผลการตรวจ</div>
         @if ($data->choice_type == '1')
                                @if (request()->category_id == 'WETTAQ0VOT8G')
                                <input type="hidden" name="choice[{{ $i++ }}]"
                                value="{{ $data->id }}">
                            <input type="text" class="form-control" name="user_chk[{{ $n++ }}]" placeholder="อ่านค่าได้..........................Kg/cm2 หรือ*100 kPa" required>
                                @else
                                <input type="hidden" name="choice[{{ $i++ }}]"
                                value="{{ $data->id }}">
                            <input type="text" class="form-control" name="user_chk[{{ $n++ }}]" required>
                                @endif
                                       
                                </div>

                            @elseif ($data->choice_type == '2')
                                <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $data->id }}">
                                <input type="date" class="form-control" name="user_chk[{{ $n++ }}]">
                                        <div id="emailHelp" class="form-text">รูปแบบวันที่ ปี ค.ศ.</div>
                                    </div>
                @elseif ($data->choice_type == '3')
                    <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $data->id }}">
            
                                        <input type="text" class="form-control"
                                            name="user_chk[{{ $n++ }}]" maxlength="10" required>
                                        <div id="emailHelp" class="form-text">ระบุวันที่ วัน/เดือน/ปี พ.ศ. เช่น
                                            11/05/2567</div>
                                        </div>
                @elseif ($data->choice_type == '4')
                    <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $data->id }}">
            
                                        <input type="number" class="form-control"
                                            name="user_chk[{{ $n++ }}]" required>
            
                                        </div>
                @elseif ($data->choice_type == '5')
                    <input type="hidden" name="choice[{{ $i++ }}]" value="{{ $data->id }}">
            
                                        <select name="user_chk[{{ $n++ }}]" class="form-select">
                                            <option value="1" selected>ปกติ</option>
                                            <option value="0">ไม่ปกติ</option>
                                        </select>
                                    </div>
     @endif

                                <div class="col-md-6 mb-2">
                                    <div id="emailHelp" class="form-text text-danger">
                                        <img src="{{asset('images/image-upload.png')}}" width="25px"> อัพโหลดภาพถ่ายกรณีชำรุด/พบข้อบกพร่อง</div>
                                   
                                    <input class="form-control" id="formFileSm"
                                        name="choice_img[{{ $m++ }}]" type="file" accept="image/*">
                                    </div>

                                    <div class="col-md-6">
                                    <input class="form-control" type="text"
                                        name="user_remark[{{ $a++ }}]" placeholder="กรอกรายละเอียดข้อบกพร่อง">
                                </div>
                                <hr>
                            @endforeach

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-primary">บันทึกและไปต่อ</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
