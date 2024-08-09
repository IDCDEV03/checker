@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">รายชื่อบริษัทขนส่ง</div>

                    <div class="card-body">
              
                        <table class="table table-responsive cell-border" id="dataTables">

                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th width="30%">ชื่อบริษัทขนส่ง</th>
                                <th>ที่อยู่</th>
                                <th scope="col">วันที่เพิ่ม</th>
                              
                              </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($ts_detail as $item)
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                   <td>
                                        <a href="{{route('leader_Plate',['id'=>$item->id])}}">
                                        {{$item->ts_name}}
                                        </a>
                                  </td>

                                <td> 
                                    {{$item->ts_address}} {{$item->ts_tambon}} {{$item->ts_amphur}}, จ.{{$item->ts_province}} {{$item->ts_zipcode}}
                                </td>
                                
                                <td>
                                    {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
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
