@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ตั้งค่าบัญชีผู้ใช้</div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">กลุ่มผู้ใช้</th>
                                <th scope="col">ตั้งค่า</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>ผู้ใช้ทั่วไป/ผู้เรียน</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="" class="btn btn-primary">รายชื่อ</a>
                                        
                                       
                                      </div>    
                                </td>                             
                              </tr>

                              <tr>
                                <th scope="row">2</th>
                                <td>เจ้าหน้าที่/หัวหน้าฝ่าย</td>
                                <td>  <div class="btn-group btn-group-sm" role="group">
                                    <a href="" class="btn btn-primary">รายชื่อ</a>
                                   
                                  </div> 
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
