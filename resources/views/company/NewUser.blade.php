@extends('layouts.companyapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary mb-3">
                <div class="card-header">สร้างบัญชีผู้ใช้ใหม่</div>

                <div class="card-body text-primary">
                    <form method="POST" action="{{route('company_createuser',['type'=>request()->type])}}" >
                        @csrf

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">เลขบัตรประจำตัวประชาชน</label>                       
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="user_idcard" required maxlength="13" autofocus>
                                </div>                          
                        </div>

                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" required >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ-นามสกุล</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required >
                            </div>
                        </div>
                   

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">เพศ</label>
                            <div class="col-md-6">
                              
                                    <input id="gender" type="text" class="form-control" name="gender" required >
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">ที่อยู่</label>
                            <div class="col-md-6">
                              
                                    <input id="gender" type="text" class="form-control" name="gender" required >
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">จังหวัด</label>
                            <div class="col-md-6">
                              
                                    <input id="gender" type="text" class="form-control" name="gender" required >
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">วันเกิด</label>
                            <div class="col-md-6">
                              
                                    <input id="gender" type="text" class="form-control" name="gender" required >
                              
                            </div>
                        </div>

                      

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">หลักสูตร</label>
                            <div class="col-md-6">
                            <select class="form-select" name="user_course" aria-label="Default select example">
                                <option selected disabled value="0">--เลือกหลักสูตร</option>
                                <option value="1">เรียนขับรถรถยนต์</option>
                                <option value="2">เรียนขับรถรถจักรยานยนต์</option>
                                <option value="3">เรียนขับรถรถบรรทุก</option>
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
