@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">รายงานการตรวจเช็ค</div>

                    <div class="card-body">

                      <div class="text-center h5 mb-3">

                        @foreach ($formName as $row)
                                {{$row->form_name}}
                        @endforeach

                    </div>

                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th>ว/ด/ป ที่บันทึก</th>
                                <th scope="col">ชื่อผู้บันทึก</th>                              
                             
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($record_data as $data)
                                    
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                 <a href="{{route('company_chkdetail',['round'=>$data->round_chk,'type'=>$data->form_type])}}">  {{ Carbon\Carbon::parse($data->created_at)->format('d/m/Y H:i') }} </a> 
                                </td>  
                                <td>{{$data->fullname}}</td>
                               
                                                       
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
