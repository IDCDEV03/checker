@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">ข้อมูลรถขนส่ง
                    
                </div>
                    <div class="card-body">
                       
                    @foreach ($detail_truck as $item)
                    <p class="h5">  ทะเบียนหัว : {{$item->plate_top}} / ทะเบียนหาง : {{$item->plate_bottom}} </p>
                    <p class="h5">  ( {{$item->ts_name}} ) </p>
                   
                     
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">หัวข้อ</th>
                                <th scope="col">รายละเอียด</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">ชนิดรถ</th>
                                    <td>
                                        {{$item->form_type_name}}
                                    </td>                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">วันที่จดทะเบียนหัว</th>
                                    <td>
                                        {{$item->date_truck_enroll}}
                                    </td>                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">น้ำหนักรวมสูงสุด (T)</th>
                                    <td> {{$item->weight_max}} </td>
                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">น้ำหนักรถเปล่าหัว+หาง (T)</th>
                                    <td> {{$item->weight_all}} </td>                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">วันที่ประกันหมดอายุ</th>
                                    <td>{{ $item->truck_insure_expired }}</td>                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">ภาษีหมดอายุ</th>
                                    <td> {{ $item->truck_tax_expired }} </td>                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">ประเภทสินค้า</th>
                                    <td> {{ $item->truck_product }} </td>                                 
                                  </tr>

                                  <tr>
                                    <th scope="row">ชนิดเชื้อเพลิง</th>
                                    <td> {{ $item->truck_fuel }} </td>                                 
                                  </tr>

                            </tbody>
                          </table>
                          @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
