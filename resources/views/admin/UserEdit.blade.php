@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary mb-3">
                <div class="card-header">แก้ไขบัญชีผู้ใช้</div>

                <div class="card-body text-primary">
                    <form method="POST" action="{{route('admin_UserUpdate', ['id'=> request()->id])}}" >
                        @csrf

                      
                        @foreach($userdetail as $row)
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ-นามสกุล</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="fullname" required autofocus value="{{$row->name}}">
                            </div>

                           
                                <input type="hidden" name="agent" value="{{$row->user_dep}}">
                           
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required value="{{$row->email}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" required value="{{$row->password_2}}">
                             
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
