@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">รายการทะเบียนรถทั้งหมด
                    
                </div>
                    <div class="card-body">


                        <table class="table table-responsive cell-border" id="dataTables">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th width="30%">ทะเบียนหัว</th>
                                <th>ทะเบียนหาง</th>
                                <th scope="col">บริษัทผู้ขนส่ง</th>
                                <th scope="col">ตรวจรถ</th>
                              </tr>
                            </thead>
                            <tbody> 
                            @foreach ($truck_data as $item)
                                
                         <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{$item->plate_top}}
                            </td>
                            <td>
                                {{$item->plate_bottom}}
                            </td>
                            <td>
                                {{$item->ts_name}}
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">ตรวจรถ</a>
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
