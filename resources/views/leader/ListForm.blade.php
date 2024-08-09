@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">รายงานการตรวจเช็ค</div>
                    <div class="card-body">
                        @foreach ($formName as $row)
                        <h4> ชื่อฟอร์ม : {{$row->form_name}} </h4>
                        @endforeach
<br>
                        <table class="table" id="dataTables">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th>ว/ด/ป ที่บันทึก</th>
                                <th>ชื่อผู้รับการทดสอบ</th> 
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($record_data as $data)
                                    
                              <tr>
                                
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                 <a href="{{route('leader_detailchk',['round'=>$data->round_chk,'type'=>$data->form_type])}}">  {{ Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }} </a> 
                                </td>  
                                 <td>{{ $data->fullname }}</td>
                                                       
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
