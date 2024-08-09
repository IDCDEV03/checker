@extends('layouts.companyapp')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning mb-3">
                <div class="card-header">เพิ่มบริษัทผู้ขนส่งใหม่</div>

                <div class="card-body ">
                    <form method="POST" action="#" >
                        @csrf
                        @foreach ($ts_detail as $item)
                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">ชื่อบริษัท<span class="text-danger">*</span></label>                       
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ts_name" value="{{$item->ts_name}}">
                                </div>                          
                        </div>

                 
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ที่อยู่<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="ts_address" value="{{$item->ts_address}}">
                            </div>
                        </div>
                   

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">จังหวัด<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                              
                                <input name="ts_province" class="form-control" value="{{$item->ts_province}}">
                           
                           
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">อำเภอ<span class="text-danger">*</span></label>
                            <div class="col-md-6">

                              
                                <input name="ts_amphur" class="form-control" value="{{$item->ts_amphur}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">ตำบล<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                <input name="ts_tambon" class="form-control" value="{{$item->ts_tambon}}">
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                              
                               
                                <input name="ts_zipcode" class="form-control" value="{{$item->ts_zipcode}}">
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">เบอร์โทร</label>
                            <div class="col-md-6">
                              
                             <input id="phone" type="text" class="form-control" name="phone" value="{{$item->ts_phone}}" >
                              
                            </div>
                        </div>

                  
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   บันทึก
                                </button>
                            </div>
                        </div>        

                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
