@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success mb-3">
                <div class="card-header">แก้ไขข้อมูล</div>
                 @foreach($userdetail as $row)
                <div class="card-body text-primary">
                    <form method="POST" action="{{ route('admin_AgentUpdate',['id'=>request()->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="formFileSm" class="col-md-4 col-form-label text-md-end">Logo เดิม</label>
                            <div class="col-md-6">
                         @if ($row->user_logo == '0')
                         @else
                         <img src="{{asset($row->user_logo)}}" width="100px">                             
                         @endif
                            </div>
                          </div>

                        <div class="row mb-3">
                            <label for="formFileSm" class="col-md-4 col-form-label text-md-end">Logo ใหม่</label>
                            <div class="col-md-6">
                            <input class="form-control form-control-sm" name="user_logo" id="formFileSm" type="file" accept="image/*">
                            </div>
                          </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ-นามสกุล</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="fullname" value="{{$row->fullname}}">
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
