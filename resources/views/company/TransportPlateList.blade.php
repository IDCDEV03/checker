@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">บริษัทขนส่ง
                    
                </div>
                    <div class="card-body">
                        <p class="h4">
                            @foreach ($ts_detail as $row)
                                {{$row->ts_name}} ({{$row->ts_province}})
                            @endforeach
                        </p>
                        <hr>
<p>
    <a class="btn btn-sm btn-outline-secondary" href="{{route('company_TransportCreate')}}" role="button">เพิ่มรถ</a>

    <a class="btn btn-sm btn-outline-primary" href="{{route('company_TypeChk',['id'=>Auth::user()->user_id,'ts'=>request()->id])}}" role="button">ตรวจรถ</a>
</p>

                        <table class="table table-responsive cell-border" id="dataTables">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th width="30%">ชื่อบริษัทขนส่ง</th>
                                <th>ที่อยู่</th>
                                <th scope="col">วันที่เพิ่ม</th>
                                <th scope="col">ตั้งค่า</th>
                              </tr>
                            </thead>
                            <tbody>
                               
                              <tr>
                                <th scope="row"></th>
                                   <td>
                                        <a href="">
                                        
                                        </a>
                                  </td>

                                <td> 
                                    
                                </td>
                                
                                <td>
                                   
                                </td>
                               
                                <td> 
                                   
                                        
                                       
                                                                       
                                </td>                             
                              </tr>
                           
                              
                             
                            </tbody>
                          </table>

                      

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
