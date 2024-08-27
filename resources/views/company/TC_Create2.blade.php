@extends('layouts.companyapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary mb-3">
                <div class="card-header">เพิ่มข้อมูลรถ</div>


                <div class="card-body">
                    <form method="POST" action="{{route('company_inserttruck2')}}" >
                        @csrf

                       
 <div class="row mb-3">
    <label class="col-md-4 col-form-label text-md-end">บริษัทขนส่ง
        <span class="text-danger">*</span>  
    </label>

    <div class="col-md-6">
        <select class="form-select" name="transport_id">
            <option selected disabled>-เลือก</option>
            @foreach ($transport_company as $row)
                 <option value="{{$row->id}}">{{$row->ts_name}}</option>
            @endforeach   
          </select>
    </div>
</div>

       <input type="hidden" name="truck_id" value="{{ Str::upper(Str::random(10)); }}">
        <div class="row mb-3">
            <label for="course" class="col-md-4 col-form-label text-md-end">ทะเบียนหัว
            <span class="text-danger">*</span>    
            </label>                       
                <div class="col-md-6">
                    <input type="text" class="form-control" name="plate_top" maxlength="9" required autofocus>
                </div>                          
        </div>

        <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-end">ทะเบียนหาง
                    
                </label>                       
                <div class="col-md-6">
                    <input type="text" class="form-control" name="plate_bottom" maxlength="9">
                </div>                          
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">ชนิดรถ
                <span class="text-danger">*</span>  
            </label>

            <div class="col-md-6">
                <select class="form-select" name="truck_type">
                    <option selected disabled>-เลือก</option>
                    @foreach ($truck_type as $row)
                         <option value="{{$row->id}}">{{$row->form_type_name}}</option>
                    @endforeach
                    
                   
                  </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">วันที่จดทะเบียนหัว
                <span class="text-danger">*</span>  
            </label>

            <div class="col-md-6">
                <input type="text" class="form-control" maxlength="10" placeholder="ระบุ วัน/เดือน/ปี พ.ศ. ตัวอย่าง 09/11/2561" name="date_truck_enroll" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">น้ำหนักรวมสูงสุด (T) <span class="text-danger">*</span>  </label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="weight_max" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">น้ำหนักรถเปล่าหัว+หาง(T) <span class="text-danger">*</span>  </label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="weight_all" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">วันที่ประกันหมดอายุ
                <span class="text-danger">*</span>  
            </label>

            <div class="col-md-6">
                <input type="date" class="form-control" name="truck_insure_expired" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">วันที่ภาษีหมดอายุ <span class="text-danger">*</span>  </label>

            <div class="col-md-6">
                <input type="date" class="form-control" name="truck_tax_expired" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">ประเภทสินค้า</label>

            <div class="col-md-6">
                <select class="form-select" name="truck_product">     
                    <option selected disabled>-เลือก</option>
                    <option value="1">ปูนถุง</option>
                    <option value="2">ปูนผง</option>
                    <option value="3">ปูนเม็ด</option>                    
                    <option value="4">ผสมคอนกรีต</option>
                  </select>
            </div>

        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">ชนิดเชื้อเพลิง</label>

            <div class="col-md-6">

                <select class="form-select" name="truck_fuel">     
                    <option selected disabled>-เลือก</option>
                    <option value="น้ำมัน">น้ำมัน</option>
                    <option value="NGV">NGV</option>
                  </select>

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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
