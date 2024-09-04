@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">ตรวจรถ ส่วนที่ 1</div>
                    
                    <div class="card-body">
@foreach ($Chk_part1 as $item)

                        <table class="table table-responsive">                           
                            <tbody>
                                <tr>
                                    <th scope="row" width="30%">บริษัทขนส่ง</th>
                                    <td> {{$item->ts_name}} </td>                                   
                                  </tr>
                              <tr>
                                <th scope="row">ทะเบียนหัว</th>
                                <td> {{$item->plate_top}} </td>
                              </tr>
                              <tr>
                                <th scope="row">ทะเบียนหาง</th>
                                <td> {{$item->plate_bottom}} </td>
                              </tr>
                              <tr>
                                <th scope="row">แบบฟอร์มตรวจ</th>
                                <td> {{$item->form_name}} </td>
                              </tr>
                            </tbody>
                          </table>
                          

<form action="{{route('leader_ChkPart1',['truckid'=>request()->id])}}" method="POST" enctype="multipart/form-data">
  @csrf
<input type="hidden" name="form_id" value="{{$item->form_id}}">
<input type="hidden" name="transport_id" value="{{$item->transport_id}}">
  @endforeach
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 1<span class="text-danger">*</span> </label>
                            <input class="form-control" type="file" name="img_1" id="formFile" accept="image/*" required>
                          </div>
<hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 2<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="img_2" id="formFile" accept="image/*" required>
                          </div>
                          <hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 3<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="img_3" id="formFile" accept="image/*" required>
                          </div>
                          <hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 4<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="img_4" id="formFile" accept="image/*" required>
                          </div>
                          <hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 5</label>
                            <input class="form-control" type="file" name="img_5" id="formFile" accept="image/*">
                          </div>
                          <hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 6</label>
                            <input class="form-control" type="file" name="img_6" id="formFile" accept="image/*">
                          </div>
                          <hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 7</label>
                            <input class="form-control" type="file" name="img_7" id="formFile" accept="image/*">
                          </div>
                          <hr>
                          <div class="mb-3">
                            <label class="form-label">รูปถ่ายรถ ภาพที่ 8</label>
                            <input class="form-control" type="file" name="img_8" id="formFile" accept="image/*">
                          </div>
                          <hr>
                          <button type="submit" class="btn btn-success">บันทึก</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
