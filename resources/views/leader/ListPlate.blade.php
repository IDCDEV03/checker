@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">รายการทะเบียนรถทั้งหมด</div>
                    <div class="card-body">

                        <br>
                        <table class="table table-responsive cell-border" id="dataTables">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th width="20%">ทะเบียนหัว</th>
                                    <th>ทะเบียนหาง</th>
                                    <th scope="col">บริษัทผู้ขนส่ง</th>
                                    <th>จำนวนครั้ง</th>
                                    <th scope="col">ตรวจรถ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($truck_data as $item)
                                @php
                                $id = $item->truck_id;
                    $chk_truck = DB::table('chk_truck_part1s')
                    ->select('chk_round') 
                    ->where('truck_id','=',$id)
                    ->count();
                    $sum_chk = ($chk_truck+1);
                                @endphp
                                    <tr>
                                        
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            {{ $item->plate_top }}
                                        </td>

                                        <td>
                                            {{ $item->plate_bottom }}
                                        </td>

                                        <td>
                                            {{ $item->ts_name }}
                                        </td>
                                        
                                        <td>
                                            {{$chk_truck}}
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-success"><i class="las la-info-circle"></i></a> 
                                            @if ($chk_truck == '2')
                                            ตรวจครบแล้ว
                                            @else
                                            <a href="{{route('leader_truckchks1',['id'=>$item->truck_id,'no'=>$sum_chk])}}" class="btn btn-sm btn-primary">ตรวจรถ ครั้งที่ {{$sum_chk}}</a>
                                            @endif
                                            
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
