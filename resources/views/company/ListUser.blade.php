@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">บัญชีผู้ใช้ 
                        @if (request()->type == 'leader')
                        :: เจ้าหน้าที่/หัวหน้าฝ่าย
                        @elseif (request()->type == 'user')
                        :: ผู้ใช้ทั่วไป
                        @endif
                </div>
                    <div class="card-body">
<p>
    <a class="btn btn-outline-success" href="{{route('company_newuser',['type'=>request()->type])}}" role="button">เพิ่มบัญชีใหม่</a>
</p>

                        <table class="table table-responsive cell-border" id="dataTables">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th>Username</th>
                                <th scope="col">ชื่อ-นามสกุล</th>
                                <th>หลักสูตร</th>
                                <th scope="col">ตั้งค่า</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($listuser as $item)
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$item->email}}</td>
                                <td>{{$item->name}}</td>
                                <td></td>
                                <td> 
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a href="{{route('company_edituser',['id'=>$item->user_id])}}" class="btn btn-outline-primary">แก้ไข</a>
                                        <a href="{{route('company_deleteuser',['id'=>$item->user_id,'type'=>request()->type])}}" onclick="return confirm('ต้องการลบ ใช่หรือไม่?');" class="btn btn-outline-danger">ลบ</a>
                                    </div>                                   
                                </td>                             
                              </tr>
                              @endforeach
                              
                             
                            </tbody>
                          </table>

                      

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
