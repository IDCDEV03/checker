@extends('layouts.companyapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary mb-3">
                <div class="card-header">แก้ไขบัญชีผู้ใช้</div>
                <form method="POST" action="{{route('company_updateuser',['id'=>request()->id])}}" >
                    @csrf
@foreach ($edituser as $row)
    
<input type="hidden" name="role" value="{{$row->role}}">
                <div class="card-body text-primary">                 
                     
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ-นามสกุล</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$row->name}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{$row->email}}">                            
                            </div>
                        </div>
<hr>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">รหัสผ่านใหม่</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" >
                                <div class="form-text text-danger">*ถ้าไม่เปลี่ยนรหัส ไม่ต้องกรอก</div>
                            </div>
                            
                        </div>
                        @endforeach
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
