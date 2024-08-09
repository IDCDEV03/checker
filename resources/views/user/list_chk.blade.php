@extends('layouts.userapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
             

                <div class="card">                   
                    <div class="card-body">
                                            
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อฟอร์ม</th>
                                <th scope="col">วันที่ตรวจ</th>
                                <th scope="col">รายละเอียด</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($chk_record as $item)
                                    
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$item->form_name}}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                                <td><a class="btn btn-sm btn-primary" href="{{route('user_FormView',['round'=>$item->round_chk])}}" role="button"><i class="las la-file-alt"></i></a></td>
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
