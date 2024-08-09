@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary mb-3">
                @foreach ($userdetail as $item)
                    
                
                <div class="card-header">สร้างบัญชีผู้ใช้ใหม่</div>

                <div class="card-body text-primary">
                    <form method="POST" action="{{route('admin_AgentInsertUser',['id'=>$item->user_id])}}" >
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">หน่วยงาน</label>

                            <div class="col-md-6">
                                <input type="text" readonly class="form-control-plaintext" id="agentname" name="agent_id" value="{{$item->fullname}}">                           
                            </div>
                        </div>
                     
                          @endforeach
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ-นามสกุล</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                       
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required >                            
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" required >                           
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="Role" class="col-md-4 col-form-label text-md-end">Role</label>
                            <div class="col-md-6">
                            <select class="form-select" id="role" name="user_role">
                                <option value="user" selected>ผู้ใช้</option>
                                <option value="leader">เจ้าหน้าที่</option>                                
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
