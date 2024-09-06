@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">รายชื่อบริษัทขนส่ง
                    
                </div>
                    <div class="card-body">
<p>
  <a class="btn btn-outline-secondary" href="{{route('company_newtruck2')}}" role="button">เพิ่มรถ</a>
    <a class="btn btn-outline-success" href="{{route('company_TransportCreate')}}" role="button">เพิ่มบริษัทใหม่</a>
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
                                @foreach ($ts_detail as $item)
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                   <td>                                   
                                    <a class="text-decoration-none" href="{{route('company_ListPlate',['id'=>$item->id])}}" >
                                        {{$item->ts_name}}
                                        </a>
                                  </td>

                                <td> 
                                    {{$item->ts_address}} {{$item->ts_tambon}} {{$item->ts_amphur}}, จ.{{$item->ts_province}} {{$item->ts_zipcode}}
                                </td>
                                
                                <td>
                                    {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                </td>
                               
                                <td> 
                                   
                                        <a href="{{route('company_TransportEdit',['id'=>$item->id])}}" class="btn btn-sm btn-outline-primary">แก้ไข</a>
                                       
                                                                       
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
